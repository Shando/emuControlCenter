﻿<?
/**
 * emuControlCenter language system file
 * ------------------------------------------
 * language:	de (deutsch)
 * author:	franz schneider / andreas scheibel
 * date:	2007/05/13
 * ------------------------------------------
 */
$i18n['popupConfig'] = array(
	// -------------------------------------------------------------
	// tooltips
	// -------------------------------------------------------------

	/* ECC */
	'lbl_ecc_hdl' =>
		"Konfiguration",
	'lbl_ecc_userfolder' =>
		"Userverzeichnis (für Bilder und Exportdateien)",
	'lbl_ecc_userfolder_button' =>
		"Ordner ändern",
	'title_ecc_userfolder_popup' =>
		"Verzeichnis wählen",
	/* ECC-OPTIONS */
	'lbl_ecc_otp_hdl' =>
		"Optionen",
	'lbl_ecc_opt_detail_pp' =>
		"Details pro Seite",
	'lbl_ecc_opt_list_pp' =>
		"Dateien pro Listenseite",
	/* ECC-COLOR&FONTS */
	'lbl_ecc_colfont_hdl' =>
		"Farben und Schriftarten",
	'lbl_ecc_colfont_font_list' =>
		"Listen Schriftart",
	'title_ecc_colfont_font_list_popup' =>
		"Bitte wähle eine Schriftart für die Listen/Detailansicht.",
	'lbl_ecc_colfont_font_global' =>
		"GLOBALE Schriftart",
	'title_ecc_colfont_font_global' =>
		"Bitte wähle eine GLOBALE Schriftart ",
	/* ECC-STARTUP */
	'lbl_ecc_startup_hdl' =>
		"Startup Konfiguration",
	'btn_ecc_startup' =>
		"Konfiguration öffnen",

	/* EMU-PLATFORM */
	'lbl_emu_hdl%s%s' =>
		"%s (%s)",
	'lbl_emu_platform_name' =>
		"Platform Name",
	'lbl_emu_platform_category' =>
		"Platform Kategorie",
	/* EMU-ASSING */
	'lbl_emu_assign_hdl%s' =>
		"Emulator zuweisen (%s)",
	'lbl_emu_assign_path' =>
		"Ordner -> Emulator",
	'btn_emu_assign_path_select' =>
		"Emulator auswählen",
	'title_emu_assign_path_select_popup%s' =>
		"Emulator auswählen für %s",
	'lbl_emu_assign_parameter' =>
		"Komandozeilen-Parameter",
	'lbl_emu_assign_escape' =>
		"Pfad escapen",
	'lbl_emu_assign_eightdotthree' =>
		"8.3 Dateinamen",
	'lbl_emu_assign_nameonly' =>
		"Nur Dateinamen",
	'lbl_emu_assign_noextension' =>
		"Keine Dateierweiterungen",

	/* DAT */
	'lbl_dat_hdl' =>
		"Datfile Konfiguration",
	'lbl_dat_author' =>
		"Autor",
	'lbl_dat_website' =>
		"Website",
	'lbl_dat_email' =>
		"Email",
	'lbl_dat_comment' =>
		"Kommentar",

	/* DAT-OPTIONS */
	'lbl_dat_opt_hdl' =>
		"Optionen",
	'lbl_dat_opt_namestrip' =>
		"Bereinige Romcenter Dateien",

	/* 0.9 FYEO 3 */
	'lbl_img_otp_list_hdl' =>
		"Optionen - Rom Details",
	'lbl_img_otp_list_imagesize' =>
		"Bildgröße",
	'lbl_img_otp_list_aspectratio' =>
		"Originalformat",

	/* 0.9 FYEO 4 */
	'lbl_img_otp_list_fastrefresh' =>
		"Listen schnell aufbauen",

	/* 0.9 FYEO 9 */
	'confEccStatusLogCheck' =>
		"Aktiviere logging",
	'confEccStatusLogOpen' =>
		"Öffne Logfiles",

	/* 0.9.1 FYEO 5 */
	'tab_label_emulators' =>
		"Emulatoren",
	'tab_label_general' =>
		"General",
	'tab_label_datfiles' =>
		"Datfiles",
	'tab_label_multimedia' =>
		"Multimedia",
	'tab_label_colorsandfonts' =>
		"Farben und Schrift",

	/* 0.9.2 FYEO 1 */
	'lbl_emu_tips' =>
		"Emulatoren Tips / Tricks / Downloads",
	'lbl_img_opt_conv' =>
		"Bildkonvertierung",
	'lbl_img_opt_conv_quality' =>
		"Thumb Qualität",
	'lbl_img_opt_conv_quality_def%s' =>
		"(Voreinstellung: %s)",
	'lbl_img_opt_conv_minsize' =>
		"Min. Originalgröße",
	'lbl_img_opt_conv_minsize_def%s' =>
		"(Voreinstellung: %s)",
	'lbl_col_opt_global' =>
		"Global",
	'lbl_col_opt_list' =>
		"Liste",
	'lbl_col_opt_options' =>
		"Optionen",

	/* 0.9.2 FYEO 3 */
	'lbl_emu_assign_use_eccscript' =>
		"eccScript",

	/* 0.9.2 FYEO 5 */
	'lbl_emu_assign_edit_eccscript' =>
		"eccScript ändern",
	'lbl_emu_assign_edit_eccscript_error' =>
		"Es kann erst ein ECC-Script angelegt werden, wenn zuvor ein Emulator gewählt wurde!",

	/* 0.9.2 FYEO 6 */
	'lbl_emu_assign_eccscript_hdl' =>
		"eccScript Optionen",
	'lbl_emu_assign_delete_eccscript' =>
		"Löschen",
	'msg_emu_assign_delete_eccscript%s' =>
		"Willst Du das eccScript\n\n%s\n\nwirklich löschen?",

	/* 0.9.2 FYEO 8 */
	'tab_label_startup' =>
		"Start",
	'startConfHdl' =>
		"Startkonfiguration",
	'startConfSoundHdl' =>
		"Startsound abspielen",
	'startConfOptHdl' =>
		"Optionen",
	'startConfUpdate' =>
		"Beim starten nach Updates suchen",
	'startConfMinimize' =>
		"Minimieren in die Schnellstartleiste",
	'startConfSoundSelect' =>
		"Sound auswählen",

	/* 0.9.2 FYEO 9 */
	'lbl_preview_impossible' =>
		"Vorschau nicht möglich. Fehlende oder falsche Einstellungen!",

	/* 0.9.2 FYEO 10 */
	'lbl_emu_assign_edit_eccscript_error_notfound' =>
		"Es wurde kein Emulator gefunden! Bitte zuerst einen Emulator auswählen!",
	'lbl_emu_assign_create_eccscript' =>
		"Neuer eccScript",
	'emu_info_nodata' =>
		"Zur Zeit sind noch keine informationen verfügbar ...",
	'emu_info_footer%s' =>
		"Kennst Du weitere Emulatoren?\nBesuche das ecc-Forum\n%s\nund teile sie uns mit!",

	/* 0.9.2 FYEO 11 */
	'title_startup_select_sound' =>
		"Wähle einen Startsound!",

	/* 0.9.2 FYEO 14 */
	'title_emu_assign_found_eccscript' =>
		"eccScript gefunden",
	'msg_emu_assign_found_eccscript%s' =>
		"Ein eccScript wurde für den gewählten Emulator gefunden!\n\nSoll dieses eccScript (%s) aktiviert werden?",
	'title_popup_save' =>
		"Neustart",
	'msg_popup_save' =>
		"Das emuControlCenter muss neu gestartet werden, damit die Änderungen wirksam werden!",

	/* 0.9.2 FYEO 15 */
	'title_emu_found_eccscript_preview' =>
		"Informationen:",
	'title_emu_found_eccscript_nopreview' =>
		"Keine Informationen verfügbar!",

	/* 0.9.6 FYEO 05 */
	'lbl_emu_assign_executeinemufolder' =>
		"Im Emu-Verzeichnis starten",
	'lbl_preview_selectEmuFirst' =>
		"Du hast noch keinen Emulator ausgewählt! Benutze den Button 'Emulator wählen'!",

	/* 0.9.6 FYEO 13 */


	'winTitleConfiguration' =>
		"Konfiguration",

	'colOptGlobalFont' =>
		"Schriftart",

	'colOptListBg0' =>
		"Hintergrund",
	'colOptListBg1' =>
		"Hintergrund 1",
	'colOptListBg2' =>
		"Hintergrund 2",
	'colOptListBgHilight' =>
		"Hintergrund gewählt",
	'colOptListBgImage' =>
		"Hintergrund Bild",
	'colOptListText' =>
		"Text",
	'colOptListTextHilight' =>
		"Text ausgewählt",
	'colOptListFont' =>
		"Schriftart",

	'colOptOptionsBg1' =>
		"Hintergrund 1",
	'colOptOptionsBgHilight' =>
		"Hintergrund gewählt",
	'colOptOptionsText' =>
		"Text",

	/* 0.9.6 FYEO 17 */
	'colImgSlotUnsetBg' =>
		"Hintergrund unbelegt",
	'colImgSlotSetSelect' =>
		"Hintergrund unbelegt gewählt",
	'colImgSlotSetBg' =>
		"Hintergrund belegt",
	'colImgSlotUnsetSelect' =>
		"Hintergrund belegt gewählt",
	'colImgSlotText' =>
		"Text",

	'colOptOptionsBg2' =>
		"Hintergrund 2",

	'tabEmuConfig' =>
		"Emulator Konfig",
	'tabEmuPlatformSettings' =>
		"Platform Einstellungen",
	'tab_label_platforms' =>
		"Platform / Emulator",
	
	/* 0.9.6 WIP 18 */
	'confEccSaveViewSettings' =>
		"Speichere Ansicht-Einstellungen (fur für Experten)",

	/* 0.9.6 WIP 19 */
	'tabEmuInfos' =>
		"Links & Infos",
		
	/* 0.9.6 WIP 20 */
	'startConfBugreportSend' =>
		"Fehlerbericht automatisch versenden",
	'lbl_ecc_opt_language' =>
		"Spracheinstellungen",
	'tab_label_language' =>
		"Sprache",
	
	/* 0.9.7 WIP 01 */
	'confEccSilentParsing' =>
		"Stilles ROM parsing (keine Popups)",
		
	'emuAssignGlobalEnableEccScript' =>
		"aktiviere eccScript",
	'emuAssignFileextLabel' =>
		"Emulator für Dateiendung",
	'emuAssignPreviewLabel' =>
		"Kommandozeilen Vorschau",
	'emuAssignGlobalActive%s' =>
		"Starte roms mit der Dateiendung '%s' mit diesem Emulator",
	'emuAssignGlobalActiveGlobal%s' =>
		"Aktiviere catch all Emulator '%s'",
	'lbl_emu_tips_ecc' =>
		"ecc links",	
	'emuPlatformActiveState' =>
		"Aktiviere Platform",
	'tabGeneralHlListOptions' =>
		"Listen Optionen",	
		
	/* 0.9.7 WIP 04 */
	'tab_label_themes' =>
		"Themes",
	'lblThemeSelect' =>
		"Theme wählen",

	/* 0.9.7 WIP 10 */
	'emuAssignLabelZipUnpack' =>
		"ZIP/7ZIP extrahieren",
	'emuAssignGlobalCheckZipUnpackActive' =>
		"Entpacke ZIP/7ZIP Dateien automatisch",
	'emuAssignGlobalCheckZipUnpackSkip' =>
		"Überspringe schon entpackte Dateien (schneller)",
	'emuAssignGlobalCheckZipUnpackClean' =>
		"Bereinige das ecc-unpack Verzeichnis für diese Platform",
	'emuAssignGlobalCheckZipUnpackOpen' =>
		"Öffne das ecc-unpack Verzeichnis",

	/* 0.9.7 WIP 10 */
	'conEccSaveGuiSettings' =>
		"Speicher GUI-Einstellungen",

	/* 0.9.8 WIP 02 */
	'lbl_img_otp_list_imagesize_default' =>
		"Grundeinstellung: 120x80",
	'lbl_img_otp_list_aspectratio_default' =>
		"Grundeinstellung: aus",
	'lbl_img_otp_list_fastrefresh_default' =>
		"Grundeinstellung: aus - Experimentell",

	/* 0.9.8 WIP 04 */
	'lbl_emu_assign_usecuefile' =>
		"verwende CD-index (cue,ccd,toc,m3u) datei",
		
    /* 0.9.9. WIP 01 */
	'startConfThirdPartyHdl' =>
		"Third Party",

    /* 0.9.9. WIP 06 */
	'emuAssignGlobalEccScriptOptions' =>
		"Optionen",
	'lbl_emu_assign_refresh_eccscript' =>
		"Aktualisieren",

	/* 1.11 BUILD 6 */
	'emuAssignGlobalCheckZipUnpackAll' =>
		"Entpacke ALLE Dateien inklusive der Unterverzeichnisse",
	'emuUnpackNotelabel' =>
		'Hinweis: Im Register [Start] kannst du den "unpack" Ordner leeren, wenn ECC beendet wird.',
	'startConfDeleteUnpacked' =>
		"Leere den ECC 'unpack' Ordner beim Beenden.",

	/* 1.13 BUILD 4-8 */
	'eccVideoPlayer_enable' =>
		"Enable Video Player",
	'eccVideoPlayer_sound' =>
		"Enable sound",
	'eccVideoPlayer_soundvolume' =>
		"Volume (0-200%) =",
	'eccVideoPlayer_loop' =>
		"Loop video",
	'eccVideoPlayer_resolution' =>
		"Resolution (pixels): ",
	'eccVideoPlayer_padding' =>
		"Padding from rightbottom corner (pixels): ",

	/* 1.13 BUILD 12 */		
	'lbl_ecc_opt_hdl' =>
		"Other options",
	'tabGeneralImageTabOptions' =>
		"IMAGE TAB in main view options",
	'tabGeneralImageTabTcuttLabel' =>	
		"Text cuttoff length (characters):",
	'tabGeneralParsingUnpackingOptions' =>	
		"Parsing / Unpacking options",
	'tabGeneralParsingTriggerLabel' =>	
		"Big file parser trigger size (MB)",
	'tabGeneralParsingTriggerNoteLabel' =>	
		"(experimental, PHP could crash if set to high)",
	'ThemeSelectLabel' =>
		"Theme:",

	/* 1.152 BUILD 04 */		
	'tabGeneralUnpackGUITriggerLabel' =>	
		"Unpack GUI (progressbar) trigger size (MB)",
	'tabGeneralUnpackGUITriggerNoteLabel' =>	
		"(depends on computer speed / wait time)",

	/* 1.152 BUILD 06 */		
	'lblUseThemeColors' =>	
		"Use theme colors",

	/* 1.20 */		
	'DatabaseFolderLabel' =>	
		"Database folder:",
	'DatabaseFolderButton' =>	
		"Change folder",		
	'dialogDatabaseFolder' =>	
		"Select a map to store the database",

	/* 1.21 */		
	'extProgDaemontoolsButton' =>
		"Select",	
	'extProgJoyEmulatorLabel' =>
		"Joystick emulator:",	
	'startConfJoyEmulatorLabel' =>	
		"Start Joystick emulator on ECC startup",
    'dialogJoyEmulatorFolder' =>	
		"Locate Joystick emulator executable",
	'extProgJoyEmulatorbutton' =>
		"Select",	

	/* 1.22 */
	'extProgJoyEmulatorParamLabel' =>
	"Commandline parameter(s):",
);
?>