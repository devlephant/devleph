<?return
[
'GROUP'   =>'internet',
'CLASS'   =>basenameNoExt(__FILE__),
'CAPTION' =>t('TChromium_Caption'),
'SORT'    =>54,
'NAME'    =>'chromium',
'W' =>40,
'H' =>30,
'USE_SKIN' =>true,

'DLLS' => ['locales', 'swiftshader', 'cef_sandbox.lib', 'cef.pak', 'cef_100_percent.pak', 'cef_200_percent.pak', 'cef_extensions.pak',
'chrome_elf.dll', 'd3dcompiler_43.dll', 'd3dcompiler_47.dll', 'devtools_resources.pak', 'icudtl.dat',
'libcef.dll', 'libcef.lib', 'libEGL.dll', 'libGLESv2.dll', 'natives_blob.bin', 'snapshot_blob.bin', 'v8_context_snapshot.bin'],
];