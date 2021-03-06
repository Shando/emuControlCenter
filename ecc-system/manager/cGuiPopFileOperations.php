<?
define('TAB_RENAME', 0);
define('TAB_COPY', 1);
define('TAB_DELETE', 2);
define('TAB_SEARCH', 3);

class GuiPopFileOperations extends GladeXml {
	
	public $done = NULL;
	
	public $destinationSearch = false;
	
	public function __construct($gui = false) {
		if ($gui) $this->mainGui = $gui;
		$this->prepareGui();
	}
	
	private function prepareGui() {
		parent::__construct(ECC_DIR_SYSTEM.'/gui/guiPopFileOperations.glade');
		$this->signal_autoconnect_instance($this);
		$this->guiFileOperations->modify_bg(Gtk::STATE_NORMAL, GdkColor::parse("#FFFFFF"));
		$this->guiFileOperations->set_modal(true);
		
		$this->translateGui();
		
		$this->guiFileOperations->present();
	}
	
	public function setFdataId($fdataId) {
		if (!$fdataId) return false;
		$this->fdataId = $fdataId;
	}
	
	public function setSourceFileName($sourceFileName) {
		if (!realpath($sourceFileName)) $this->addError('Could not found source-path!');
		$this->sourceFileName = $sourceFileName;
	}

	public function setDestinationSearch($destinationSearch) {
		if (!count($destinationSearch)) $this->addError('No files found!');
		$this->destinationSearch = $destinationSearch;
	}
	
	
	public function setDestinationFileName($destinationFileName) {
		$this->destinationFileName = $destinationFileName;
	}
	
	
	public function openRenameDialog($hideOnFail = false) {
		$this->prepareDialogFor(TAB_RENAME);
	}

	public function openCopyDialog() {
		$this->prepareDialogFor(TAB_COPY);
	}

	public function openDeleteDialog() {
		$this->prepareDialogFor(TAB_DELETE);
	}

	public function openSearchDialog() {
		
		// cannot hide the tabs, so i make them not sensitive!
		$this->vbox32->set_sensitive(false); // copy
		$this->vbox30->set_sensitive(false); // rename
		$this->vbox31->set_sensitive(false); // delete
		$this->prepareDialogFor(TAB_SEARCH);
	}
	
	private function prepareDialogFor($tabName) {
		
		$this->done = NULL;
		
		$this->selectNotebookTab($tabName);
		
		// rename

		// source
		$fileExtension = ".".FACTORY::get('manager/FileIO')->get_ext_form_file(basename($this->sourceFileName));
		
		$this->renameTxtSourcePath->set_text(dirname($this->sourceFileName));
		$this->renameTxtSourceFileName->set_text(basename($this->sourceFileName));
		
		if ($this->destinationFileName){
			$renameDestinationFileName = $this->destinationFileName;
		}
		else {
			$renameDestinationFileName = $this->sourceFileName;
			$renameDestinationFileName = basename(str_ireplace($fileExtension, '', $renameDestinationFileName));
		}
		$this->renameTxtDestinationFileName->set_text($renameDestinationFileName);
		
		// destination
		$this->renameTxtDestinationExtension->set_text(strtolower($fileExtension));
		
		// copy
		$this->copyTxtSourcePath->set_text(dirname($this->sourceFileName));
		$this->copyTxtSourceFileName->set_text(basename($this->sourceFileName));
		$copyDestinationFileName = (file_exists($this->destinationFileName)) ? $this->destinationFileName : $this->sourceFileName;
		$this->copyTxtDestinationFileName->set_text(dirname($copyDestinationFileName));
		
		// delete
		$this->removeTxtSourcePath->set_text(dirname($this->sourceFileName));
		$this->deleteTxtSourceFileName->set_text(basename($this->sourceFileName));
		
		// only activate, if search is selected
		$this->searchTab->set_sensitive($this->destinationSearch);
		$this->searchTabContent->set_sensitive($this->destinationSearch);
		
		
		$this->show();
	}
	
	private function selectNotebookTab($tabName) {
		$this->fileOperationsNotebook->set_current_page($tabName);
	}
	
	public function onNoteBookChanged($oNoteBook, $oUnknown) {
	}
	
	public function show() {
		$this->guiFileOperations->show();
	}
    
	public function onCopyChooseFolder() {
		$selectedPath = FACTORY::get('manager/Os')->openChooseFolderDialog($this->copyTxtSourcePath->get_text(), 'Please select destination', false);
		if ($selectedPath) $this->copyTxtDestinationFileName->set_text($selectedPath);
	}
	
	public function onSearchChooseFolder() {
		$selectedPath = FACTORY::get('manager/Os')->openChooseFolderDialog($this->searchTextEntryLocation->get_text(), 'Please select destination', false);
		if ($selectedPath) $this->searchTextEntryLocation->set_text($selectedPath);
	}
	
    function onClickButtonCopy() {
    	
    	if (!$this->fdataId) $this->addError('fdataId missing!');
    	$fdataId = $this->fdataId;
    	
        $pathSource = $this->copyTxtSourcePath->get_text();
        if (!file_exists($pathSource)) $this->addError('source file not found!');;
        
    	$fileNameSource = $pathSource.DIRECTORY_SEPARATOR.$this->copyTxtSourceFileName->get_text();
    	$fileNameDestination = $this->copyTxtDestinationFileName->get_text();

		if (!realpath($fileNameDestination)) $this->addError('destination path not found!');;
		$fileNameDestination = realpath($fileNameDestination).DIRECTORY_SEPARATOR.basename($fileNameSource);
    	
    	$oFileOperations = FACTORY::get('manager/FileIO');
    	if ($oFileOperations->copyFile($fileNameSource, $fileNameDestination)) {
    		
    		if(LOGGER::$active) LOGGER::add('files', "file copy: ".$fileNameSource." -> ".$fileNameDestination, 0);
    		
    	    if (FACTORY::get('manager/TreeviewData')->updatePathById($fdataId, $fileNameDestination)) {
    			$this->hideWindow();
    			if ($this->mainGui) $this->mainGui->onReloadRecord(false);
    		}
    		else {
    			FACTORY::get('manager/Gui')->openDialogInfo('Error', 'could not rename file in database!', false, FACTORY::get('manager/GuiTheme')->getThemeFolder('icon/ecc_mbox_error.png', true));
    		}
    	}
    	else {
    		FACTORY::get('manager/Gui')->openDialogInfo('Error', 'could not copy file!', false, FACTORY::get('manager/GuiTheme')->getThemeFolder('icon/ecc_mbox_error.png', true));
    	}
        
        $this->copyTxtSourcePath->get_text();
        
    }
    
    function onClickButtonDelete() {
    	
    	if (!$this->fdataId) $this->addError('fdataId missing!');
    	$fdataId = $this->fdataId;
    	
    	$pathSource = $this->removeTxtSourcePath->get_text();
    	$fileName = $this->deleteTxtSourceFileName->get_text();
    	$oFileOperations = FACTORY::get('manager/FileIO');
    	if ($oFileOperations->deleteFileByFilename($pathSource.DIRECTORY_SEPARATOR.$fileName)) {
    	   	if (FACTORY::get('manager/TreeviewData')->deleteFdataById($fdataId)) {
				
    	   		if(LOGGER::$active) LOGGER::add('files', "file remove: ".$pathSource.DIRECTORY_SEPARATOR.$fileName, 0);
    	   		
    	   		# remove images from ecc-user folder
				$removeUserImages = $this->deleteCheckUserImages->get_active();
		    	if ($removeUserImages) {
		    		$fileData = FACTORY::get('manager/TreeviewData')->getFdataById($fdataId);
		    		if ($fileData['eccident'] && $fileData['crc32']) {
		    			FACTORY::get('manager/Image')->removeUserImageFolder($fileData['eccident'], $fileData['crc32']);
		    			if(LOGGER::$active) LOGGER::add('files', "-> img remove: ".$fileData['eccident']." -> ".$fileData['crc32'], 0);
		    		}
		    	}
    			$this->hideWindow();
    			if ($this->mainGui) $this->mainGui->onReloadRecord(false);
    		}
    		else {
    			FACTORY::get('manager/Gui')->openDialogInfo('Error', 'could not remove file in database!', false, FACTORY::get('manager/GuiTheme')->getThemeFolder('icon/ecc_mbox_error.png', true));
    		}
    	}
    	else {
    		FACTORY::get('manager/Gui')->openDialogInfo('Error', 'could not remove file!', false, FACTORY::get('manager/GuiTheme')->getThemeFolder('icon/ecc_mbox_error.png', true));
    	}
    }
    
    function onClickButtonRename() {
    	
    	if (!$this->fdataId) $this->addError('fdataId missing!');
    	$fdataId = $this->fdataId;
    	
    	$pathSource = $this->renameTxtSourcePath->get_text();
    	$fileNameSource = $pathSource.DIRECTORY_SEPARATOR.$this->renameTxtSourceFileName->get_text();
    	$fileNameDestination = $pathSource.DIRECTORY_SEPARATOR.basename($this->renameTxtDestinationFileName->get_text());
    	
    	// remove double extension from filename
    	$fileExtension = $this->renameTxtDestinationExtension->get_text();
        if  ($fileExtension == substr($fileNameDestination, strlen($fileExtension)*-1)) {
    		$fileNameDestination = trim(substr($fileNameDestination, 0, strlen($fileNameDestination)-strlen($fileExtension)));
    	}
    	
    	$fileNameDestination = $fileNameDestination.$fileExtension;
    	
    	$oFileOperations = FACTORY::get('manager/FileIO');
    	if ($oFileOperations->renameFile($fileNameSource, $fileNameDestination)) {
    		if (FACTORY::get('manager/TreeviewData')->updatePathById($fdataId, $fileNameDestination)) {
    			
    			if(LOGGER::$active) LOGGER::add('files', "file rename: ".$fileNameSource." -> ".$fileNameDestination, 0);
    			
    			$this->hideWindow();
    			if ($this->mainGui) $this->mainGui->onReloadRecord(false);
    		}
    		else {
    			$this->done = false;
    			FACTORY::get('manager/Gui')->openDialogInfo('Error', 'could not rename file in database!', false, FACTORY::get('manager/GuiTheme')->getThemeFolder('icon/ecc_mbox_error.png', true));
    		}
    	}
    	else {
    		$this->done = false;
    		FACTORY::get('manager/Gui')->openDialogInfo('Error', "could not rename file!\nFilename allready exists!", false, FACTORY::get('manager/GuiTheme')->getThemeFolder('icon/ecc_mbox_error.png', true));
    	}
    	$this->done = true;
    }
    
	public function onClickButtonSearchOk() {
		
		$destinationPath = trim($this->searchTextEntryLocation->get_text());
		
		$isCopymode = $this->searchRadioCopy->get_active();
		$optionCleanup = $this->searchCheckCleanup->get_active();
		$optionDuplicateFileName = $this->searchCheckCleanup->get_active();
		$optionDuplicateAddNumber = $this->searchRadioDuplicateAddNumber->get_active();
		
		if(LOGGER::$active) LOGGER::add('transferbysearchresult', "Transfer all games by search result!", 1);
		
		if($destinationPath) {
			
			$this->fileOperationErrors->set_visible(false);
			
			if(FACTORY::get('IniFile')->createDirectoryRecursive($destinationPath)) {
				
				$buffer = new GtkTextBuffer();
				$textLog = '';				
				
				$handledCrc32 = array();
				foreach ($this->destinationSearch as $fileId => $fileData) {
					
					$realSourcePath = realpath($fileData['path']);
					$realDesinationPath = $destinationPath.'/'.basename($realSourcePath);
					
					// cleanup files with duplicate crc32
					if($optionCleanup && isset($handledCrc32[$fileData['crc32']])) {
						if($isCopymode) {
							// skip only, no other update needed!
							continue;
						}
						else {
							// remove source file and database entry!
							unlink($realSourcePath);
							FACTORY::get('manager/TreeviewData')->deleteFdataById($fileId);
							
							$text = "crc dup\tremove\t".$realSourcePath;
							$textLog .= $text."\n";
							if(LOGGER::$active) LOGGER::add('transferbysearchresult', $text);
							
							continue;
						}
					}
					
					// number files to avoid overwritten files
					$renamedDestinationPath = false;
					if($optionDuplicateAddNumber && file_exists($realDesinationPath)) {
						$renamedDestinationPath = $this->findFreeFileName($realDesinationPath);
						
						$text = "name dup\trename\t".realpath($realDesinationPath)."\t".realpath($renamedDestinationPath);
						$textLog .= $text."\n";
						if(LOGGER::$active) LOGGER::add('transferbysearchresult', $text);
						
					}
					
					// if there is a new filename set, use this one!
					$destinationFile = ($renamedDestinationPath) ? $renamedDestinationPath : $realDesinationPath;
					
					if($isCopymode) {
						// copy
						copy($realSourcePath, $destinationFile);
						
						$text = "transfer\tcopy\t".realpath($realSourcePath)."\t".realpath($destinationFile);
						$textLog .= $text."\n";
						if(LOGGER::$active) LOGGER::add('transferbysearchresult', $text);
						
					}
					else {
						// move
						rename($realSourcePath, $destinationFile);
						FACTORY::get('manager/TreeviewData')->updatePathById($fileId, $destinationFile);
						
						$text = "transfer\tmove\t".$realSourcePath."\t".realpath($destinationFile);
						$textLog .= $text."\n";
						if(LOGGER::$active) LOGGER::add('transferbysearchresult', $text);

					}
					$handledCrc32[$fileData['crc32']] = $realSourcePath;
				}
				
				$this->fileOperationLogWindow->set_visible(true);
				$this->fileOperationLogButtonClose->set_visible(true);
				$this->searchButtonStandardRow->set_visible(false);
				$this->frame5->set_sensitive(false);
				$this->updateTextBuffer($this->fileOperationLog, $buffer, $textLog);
				
				#$this->hideWindow();
				#if ($this->mainGui) $this->mainGui->onReloadRecord(false);
				
			}
			else {
				$errorString = I18N::get('global', 'pathCouldntCreated');
				$this->fileOperationErrors->set_visible(true);
				$this->fileOperationErrors->set_markup("<span foreground='#aa0000'><b>$errorString</b></span>");
			}			
		}
		else {
			$errorString = I18N::get('global', 'pathNotSet');
			$this->fileOperationErrors->set_visible(true);
			$this->fileOperationErrors->set_markup("<span foreground='#aa0000'><b>$errorString</b></span>");
		}
	}
	
	public function updateTextBuffer($textViewWidget, $buffer, $text = false)
	{
		try{
			$buffer->set_text(trim($text)."\n");
		}
		catch (PhpGtkGErrorException $e) {
			$buffer->set_text('error - could not add row!!!!');
		}
		$textViewWidget->set_buffer($buffer);
	}
	
	/*
	 * signal is autoconnected in glade file!
	 */
  public function onClickButtonSearchCancel() {
  	$this->hideWindow();
  }
	
	/*
	 * return the next free numberd filename
	 * Used to avoid overwritten files
	 */
	public function findFreeFileName($file, $number = '01') {
		$numberString = '_#ecc~'.sprintf('%02d', (int)$number);
		
		$directory = dirname($file);
		$plainFileName = FACTORY::get('manager/FileIO')->get_plain_filename($file);
		$fileExtension = FACTORY::get('manager/FileIO')->get_ext_form_file($file);
		$newFileName = $directory.'/'.$plainFileName.$numberString.'.'.$fileExtension;
		
		if (!file_exists($newFileName)) {
			return $newFileName;
		}
		$number++;
		return $this->findFreeFileName($file, $number);
	}
	
	public function hideWindow() {
		$this->guiFileOperations->hide();
	}
	
	public function onClickButtonCancel() {
		$this->hideWindow();
    }
    
    public function __get($widgedName) {
    	return self::get_widget($widgedName);
    }
    
    public function addError($errorMessage) {
    	print $errorMessage;
    	$this->guiFileOperations->set_sensitive(false);
    }
    
    public function translateGui(){
    	
    	# WINDOW
    	$this->guiFileOperations->set_title(i18n::get('file', 'winTitle'));
    	
    	# RENAME
    	$this->tabLabelRename->set_label(i18n::get('global', 'rename'));
    	$this->tabRenameHl->set_markup('<b>'.i18n::get('file', 'tabRenameHl').'</b>');
    	$this->tabRenameDesc->set_text(i18n::get('file', 'tabRenameDesc'));
    	$this->lblPathRename->set_markup('<b>'.i18n::get('global', 'filePath').'</b>');
    	$this->lblOriginalFilenameRename->set_markup('<b>'.i18n::get('file', 'lblOriginalFilename').'</b>');
    	$this->lblNewFilenameRename->set_markup('<b>'.i18n::get('file', 'lblNewFilename').'</b>');
    	$this->btnDoRename->set_text(i18n::get('file', 'btnDoRename'));
    	$this->btnDoRenameCancel->set_text(i18n::get('global', 'cancel'));
    	
    	# COPY
    	$this->tabLabelCopy->set_label(i18n::get('global', 'copy'));
    	$this->tabCopyHl->set_markup('<b>'.i18n::get('file', 'tabCopyHl').'</b>');
    	$this->tabCopyDesc->set_text(i18n::get('file', 'tabCopyDesc'));
    	$this->lblPathCopy->set_markup('<b>'.i18n::get('global', 'filePath').'</b>');
    	$this->lblOriginalFilenameCopy->set_markup('<b>'.i18n::get('file', 'lblOriginalFilename').'</b>');
    	$this->lblNewLocation->set_markup('<b>'.i18n::get('file', 'lblNewLocation').'</b>');
    	$this->btnSelectFolder->set_label(i18n::get('global', 'selectFolder'));
    	$this->btnDoCopy->set_text(i18n::get('file', 'btnDoCopy'));
    	$this->btnDoCopyCancel->set_text(i18n::get('global', 'cancel'));
    	
    	# REMOVE
    	$this->tabLabelRemove->set_label(i18n::get('global', 'remove'));
    	$this->tabRemoveHl->set_markup('<b>'.i18n::get('file', 'tabRemoveHl').'</b>');
    	$this->tabRemoveDesc->set_text(i18n::get('file', 'tabRemoveDesc'));
    	$this->lblPathRemove->set_markup('<b>'.i18n::get('global', 'filePath').'</b>');
    	$this->lblFileToRemove->set_markup('<b>'.i18n::get('file', 'lblFileToRemove').'</b>');
    	$this->deleteCheckUserImages->set_label(i18n::get('file', 'deleteCheckUserImages'));
    	$this->btnDoRemove->set_text(i18n::get('file', 'btnDoRemove'));
    	$this->btnDoRemoveCancel->set_text(i18n::get('global', 'cancel'));
    	
    	# search
    	$this->searchTab->set_label(I18N::get('popup', 'searchTab'));
    	$this->searchDescription->set_markup(I18N::get('popup', 'searchDescription'));
    	$this->searchHeadlineMain->set_markup('<b>'.I18N::get('popup', 'searchHeadlineMain').'</b>');
			$this->searchHeadlineOptionSameName->set_label(I18N::get('popup', 'searchHeadlineOptionSameName'));
    	$this->searchRadioDuplicateAddNumber->set_label(I18N::get('popup', 'searchRadioDuplicateAddNumber'));
    	$this->searchRadioDuplicateOverwrite->set_label(I18N::get('popup', 'searchRadioDuplicateOverwrite'));
    	$this->searchCheckCleanup->set_label(I18N::get('popup', 'searchCheckCleanup'));
			
    	$this->searchHeadlineLocation->set_markup('<b>'.I18N::get('global', 'location').'</b>');
    	$this->searchHeadlineMode->set_markup('<b>'.I18N::get('global', 'mode').'</b>');
    	$this->searchHeadlineOptions->set_markup('<b>'.I18N::get('global', 'options').'</b>');
    	$this->searchButtonFolder->set_label(I18N::get('global', 'selectFolder'));
    	$this->searchRadioCopy->set_label(I18N::get('global', 'copy'));
    	$this->searchRadioMove->set_label(I18N::get('global', 'move'));
    	$this->searchButtonOkLabel->set_label(I18N::get('global', 'ok'));
    	$this->searchButtonCancelLabel->set_label(I18N::get('global', 'cancel'));
    	$this->fileOperationLogButtonClose->set_label(I18N::get('global', 'done'));
    	
    }
}
?>
