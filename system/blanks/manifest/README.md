<h1>mt.exe (x86/x64)</h1>

<h3>Microsoft Manifest Tool version 6.1.7716.0 - x86+x64<br/>From Windows SDK 7.1, <code>bin/</code> and <code>bin/x64</code> folders.</h3>

Note: Windows SDK 7.1 does not seems to have <code>mt.exe</code> for x64 architecture (or maybe I've deleted it..)
So I've included the (older) <code>version 5.2.3790.2076</code> for x64, from Windows SDK 7.0, the config file is same from the x86 of Windows 7.1, but you don't need it.

How to use:

<pre>
mt.exe –manifest MyApp.exe.manifest -outputresource:MyApp.exe;1
or
mt.exe –manifest MyLibrary.dll.manifest -outputresource:MyLibrary.dll;2
</pre>

<hr/>

<a href="https://msdn.microsoft.com/en-us/library/windows/desktop/aa375649(v=vs.85).aspx">https://msdn.microsoft.com/en-us/library/windows/desktop/aa375649(v=vs.85).aspx</a>

Mt.exe uses the following case-insensitive command line options.

<table Responsive="true" summary="table">
<tr Responsive="true"><th scope="col">Option</th><th scope="col">Description</th></tr>
<tr><td data-th="Option">-manifest</td><td data-th="Description">
<p>Specifies the name of the manifest file. To modify a single manifest, specify one  manifest file name.  For example, component.manifest.</p>
<p>To merge multiple  manifests, specify the names of the source manifests here.  Specify  the name of the updated manifest with either the <strong>-out</strong>, <strong>-outputresource</strong>, or <strong>-updateresource</strong>  options.  For example, the following command line requests an operation that merges two  manifests,    man1.manifest and man2.manifest, into a new manifest, man3.manifest.</p>
<p><strong>mt.exe -manifest man1.manifest man2.manifest -out:man3.manifest</strong></p>
<p>
</p><div class="alert"><strong>Note</strong>  No colon (:) is required with the <strong>-manifest</strong> option.</div>
<div> </div>

</td></tr>
<tr><td data-th="Option">-identity</td><td data-th="Description">
<p>Provides the attributes values of the <strong>assemblyIdentity</strong> element of the manifest. The argument of the <strong>-identity</strong> option is a string value containing the attribute values in fields separated by commas.  Provide the value of the <strong>name</strong> attribute in the first field, without including a "name=" substring. All the remaining fields specify the attributes and their values using the form: <em>&lt;attribute name&gt;</em>=<em>&lt;attribute_value&gt;</em>.</p>
<p>For example, to update the <strong>assemblyIdentity</strong> element of the manifest with the following information:</p>
<p>&lt;assemblyIdentity type="win32"
                    name="Microsoft.Windows.SampleAssembly"
                    version="6.0.0.0" processorArchitecture="x86"
                    publicKeyToken="a5aaf5ba15723d5"/&gt; </p>
<p>include  the following <strong>-identity</strong> option on the command line:</p>
<p><strong>-identity:</strong>"Microsoft.Windows.SampleAssembly, processorArchitecture=x86, version=6.0.0.0, type=win32, publicKeyToken=a5aaf5ba15723d5"</p>
</td></tr>
<tr><td data-th="Option">-rgs </td><td data-th="Description">
<p>Specifies the name of the registration script (.rgs) file. The <strong>-dll  </strong>option is required to use the <strong>-rgs</strong> option.</p>
</td></tr>
<tr><td data-th="Option">-tlb </td><td data-th="Description">
<p>Specifies the name of the type library (.tlb) file.  The <strong>-dll  </strong>option is required to use the <strong>-tlb</strong> option.</p>
</td></tr>
<tr><td data-th="Option">-dll </td><td data-th="Description">
<p>Specifies the name of the dynamic-link library (DLL) file. The <strong>-dll  </strong>option is required by <strong>mt.exe </strong> if the <strong>-rgs</strong> or <strong>-tlb</strong> options are used. Specify the name of the DLL you intend to eventually build from the .rgs or .tlb files.</p>
<p>For example, the following command requests an operation that generates a manifest from .rgs and .tlb files.</p>
<p><strong>mt.exe -rgs:testreg1.rgs -tlb:testlib1.tlb -dll:test.dll -replacements:rep.manifest -identity:"Microsoft.Windows.SampleAssembly, processorArchitecture=x86, version=6.0.0.0, type=win32, publicKeyToken=a5aaf5ba15723d5" -out:rgstlb.manifest</strong></p>
</td></tr>
<tr><td data-th="Option">-replacements </td><td data-th="Description">
<p>Specifies the file that contains values for the replaceable string in the .rgs file.</p>
</td></tr>
<tr><td data-th="Option">-managedassemblyname </td><td data-th="Description">
<p>Generates a manifest from the specified managed assembly.  Use with the <strong>-nodependency</strong> option to generate a manifest without dependency elements. Use with the <strong>-category</strong> option to generate a manifest with category tags. For example, if managed.dll is a managed assembly, the following command line generates the out.manifest from managed.dll.</p>
<p><strong>mt.exe -managedassemblyname:managed.dll -out:out.manifest </strong></p>
</td></tr>
<tr><td data-th="Option">-nodependency </td><td data-th="Description">
<p>Specifies an operation that generates a manifest without dependency elements.  The <strong>-nodependency</strong> option requires the <strong>-managedassemblyname</strong> option. For example, if managed.dll is a managed assembly, the following command line generates the out.manifest from managed.dll without dependency information.</p>
<p><strong>mt.exe -managedassemblyname:managed.dll -out:out.manifest -nodependency</strong></p>
</td></tr>
<tr><td data-th="Option">-category </td><td data-th="Description">
<p>Specifies an operation that generates a manifest with category tags. The <strong>-category</strong> option requires the <strong>-managedassemblyname</strong> option. For example, if managed.dll is a managed assembly, the following command line generates the out.manifest from managed.dll with category tags.</p>
<p><strong>mt.exe -managedassemblyname:managed.dll -out:out.manifest -category</strong></p>
</td></tr>
<tr><td data-th="Option">-nologo</td><td data-th="Description">
<p>Specifies an operation that is  run without displaying standard Microsoft copyright data. If  <strong>mt.exe</strong> runs as part of a build process,  this option can be used to prevent writing unwanted information into the log files. </p>
</td></tr>
<tr><td data-th="Option">-out </td><td data-th="Description">
<p>Specifies the name of the updated manifest.  If this is a single-manifest operation,  and the <strong>-out</strong> option is omitted, the  original manifest is modified. </p>
</td></tr>
<tr><td data-th="Option">-inputresource </td><td data-th="Description">
<p>Specifies an operation performed on a manifest obtained from a resource of type RT_MANIFEST.  If  the <strong>-inputresource</strong> option is used without specifying  the resource identifier, <em>&lt;resource_id&gt;</em>, the operation uses the value CREATEPROCESS_MANIFEST_RESOURCE. </p>
<p>For example, the following command requests an operation that merges a manifest from a DLL, dll_with_manifest.dll, and a  manifest file, man2.manifest.  The merged manifests are received by a manifest in the resource file of another DLL, dll_with_merged_manifests. </p>
<p><strong>mt.exe -inputresource:dll_with_manifest.dll;#1 -manifest man2.manifest -outputresource:dll_with_merged_manifest.dll;#3</strong></p>
<p>To extract the manifest from a DLL, specify the DLL file name.  For example, the following command extracts the manifest from lib1.dll and  man3.manifest receives the extracted manifest.</p>
<p><strong>mt.exe -inputresource:lib.dll;#1 -out:man3.manifest</strong></p>
</td></tr>
<tr><td data-th="Option">-outputresource </td><td data-th="Description">
<p>Specifies an operation that generates a manifest to be received by  a resource of type RT_MANIFEST.  If  the <strong>-outputresource</strong> option is used without specifying the resource identifier, <em>&lt;resource_id&gt;</em>, the operation uses the value CREATEPROCESS_MANIFEST_RESOURCE. </p>
</td></tr>
<tr><td data-th="Option">-updateresource </td><td data-th="Description">
<p>Specifies an operation that is equivalent to using the <strong>-inputresource</strong>  and <strong>-outputresource</strong> options with identical arguments. For example, the following command requests an operation that computes a hash of the files at the specified  path and updates the manifest of a resource of a portable executable (PE).</p>
<p><strong>mt.exe -updateresource:dll_with_manifest.dll;#1 -hashupdate:f:\files</strong>.</p>
</td></tr>
<tr><td data-th="Option">-hashupdate </td><td data-th="Description">
<p>Computes the hash value of the files at the specified paths and updates the value of the <strong>hash</strong> attribute of the <strong>File</strong> element with this value. </p>
<p>For example, the following command requests an operation that merges two manifest files, man1.manifest and man2.manifest, and updates the value of the <strong>hash</strong> attribute of the <strong>File</strong> element in the manifest that receives the merged information, merged.manifest.</p>
<p><strong>mt.exe -manifest man1.manifest man2.manifest -hashupdate:d:\filerepository -out:merged.manifest</strong></p>
<p>If the paths to the files are not specified, the operation searches location of the manifest specified to receive the update. For example,  the following command requests an operation that computes the updated hash value using files found by searching the location of updated.manifest.</p>
<p><strong>mt.exe -manifest yourComponent.manifest -hashupdate -out:updated.manifest</strong></p>
</td></tr>
<tr><td data-th="Option">-validate_manifest </td><td data-th="Description">
<p>Specifies an operation that performs a syntax check of the conformance of the manifest with the manifest schema.  For example, the following command requests a  check to validate the conformance of man1.manifest with its schema. </p>
<p><strong>mt.exe -manifest man1.manifest -validate_manifest</strong></p>
</td></tr>
<tr><td data-th="Option">-validate_file_hashes </td><td data-th="Description">
<p>Specifies an operation that validates the hash values of the <strong>File</strong> elements of the manifest. For example, the following command requests an operation that validates the hash values of all the  <strong>File</strong> elements of the man1.manifest.</p>
<p><strong>mt.exe -manifest man1.manifest -validate_file_hashes:"c;\files"</strong></p>
</td></tr>
<tr><td data-th="Option">-canonicalize </td><td data-th="Description">
<p>Specifies an operation to update the manifest to canonical form. For example, the following command updates man1.manifest to canonical form.</p>
<p><strong>mt.exe -manifest man1.manifest</strong></p>
</td></tr>
<tr><td data-th="Option">-check_for_duplicates </td><td data-th="Description">
<p>Specifies an operation that checks the manifest for duplicate elements. For example, the following command checks man1.manifest for duplicate elements.</p>
<p><strong>mt.exe -man1.manifest -check_for_duplicates</strong></p>
</td></tr>
<tr><td data-th="Option">-makecdfs</td><td data-th="Description">
<p>Generates .cdf files to make catalogs.  For example, to the following command requests an operation that updates the hash value and generates a .cdf file.</p>
<p><strong>mt.exe -manifest comp1.manifest -hashupdate -makecdfs -out:updated.manifest</strong></p>
</td></tr>
<tr><td data-th="Option">-verbose</td><td data-th="Description">Displays verbose debugging information. </td></tr>
<tr><td data-th="Option">-?</td><td data-th="Description">When run with -?, or with no options and arguments, Mt.exe displays help text.</td></tr>
</table>

<hr/>

Command line help:

<pre>
Microsoft (R) Manifest Tool version 6.1.7716.0
Copyright (c) Microsoft Corporation 2009. 
All rights reserved.
Usage:
-----
mt  
    [ -manifest <manifest1 name> <manifest2 name> ... ]
    [ -identity:<identity string> ]
    [ < <[-rgs:<.rgs filename>] [-tlb:<.tlb filename>]> -dll:<filename> > [ -replacements:<XML filename> ] ] 
    [ -managedassemblyname:<managed assembly> [ -nodependency ] ]
    [ -out:<output manifest name> ]
    [ -inputresource:<file>[;[#]<resource_id>] ]
    [ -outputresource:<file>[;[#]<resource_id>] ]
    [ -updateresource:<file>[;[#]<resource_id>] ]
    [ -hashupdate[:<path to the files>] ]
    [ -makecdfs ]
    [ -validate_manifest ]
    [ -validate_file_hashes:<path to the files> ]
    [ -canonicalize ]
    [ -check_for_duplicates ]
    [ -nologo ]
Options:
-------
-manifest                  Used to specify manifests that need to be processed.
                           At least one manifest name should follow this option.
                           NOTE: There is no colon(:) after -manifest.
                                    
<manifest1 name> <manifest2 name> ...   
                           Names of manifests to be processed and/or merged.
                           Required if the -manifest option is used.
                           NOTE: More than one manifest automatically indicates
                           a manifest "merge" operation.  In that case, an
                           output specified by one of -out / -outputresource /
                           -updateresource is mandatory.
                                         
-identity:<identity string>
                           The identity string contains the attributes of the
                           assemblyIdentity element.  The identity string is a
                           set of comma separated name=value pairs starting
                           with the "name" attribute's value.  e.g.:
                           "Microsoft.Windows.Common-Controls,
                           processorArchitecture=x86, version=6.0.0.0,
                           type=win32, publicKeyToken=6595b64144ccf1df".
                           NOTE: Only the "name" attribute is not of the form
                           "name=value" and it should be the first attribute in
                           the identity string.
-rgs:                      Takes the name of the .RGS (Registrar script).
-tlb:                      Takes the name of the .TLB (Typelib file).
-dll:                      Takes the name of the DLL: this represents the DLL
                           that is eventually built from the .RGS and .TLB
                           files. Required if either -rgs or -tlb is specified.
-replacements:<.XML filename>           
                           Specifies the file that contains values for
                           replaceable strings in the RGS file.
-managedassemblyname:<managed assembly> [ -nodependency ] 
                           Generates a manifest from a managed assembly.
                           -nodependency suppresses the generation
                           of dependency elements in the final manifest.
                                         
-out:<Output manifest name> 
                           Name of the output manifest.  If this is skipped
                           and only one manifest is being operated upon by the
                           tool, that manifest is modified in place.
-inputresource:<file>[;[#]<resource_id>]
                           Input the manifest from a resource of type
                           RT_MANIFEST with the specified id.
                           resource_id is restricted to be a non-negative,
                           16 bit number.
                           resource_id is optional and defaults to
                           CREATEPROCESS_MANIFEST_RESOURCE_ID (winuser.h).
-outputresource:<file>[;[#]<resource_id>]
                           Output the manifest to a resource of type
                           RT_MANIFEST with the specified id.
                           resource_id is restricted to be a non-negative,
                           16 bit number.
                           resource_id is optional and defaults to
                           CREATEPROCESS_MANIFEST_RESOURCE_ID (winuser.h).
-updateresource:<file>[;[#]<resource_id>]
                           Equivalent to specifying both -inputresource and
                           -ouputresource with identical parameters.
                           resource_id is restricted to be a non-negative,
                           16 bit number.
-hashupdate:<path to the files>         
                           Computes the hash of files specified in the file
                           elements and updates the hash attribute with this
                           value.  The searchpath for the actual files
                           specified in the file elements is specified
                           explicitly.  If <path to the files> is not
                           specified, the searchpath defaults to the location
                           of the output manifest.
-makecdfs                  Generates Catalog Definition Files (.cdf) - used to
                           make catalogs.
                                    
-validate_manifest         Validates to check syntactic correctness of a
                           manifest and its conformance to the manifest schema.
-validate_file_hashes:<path to the files> 
                           Validates the hash values of all the file elements.
                                        
-canonicalize              Does a C14N canonicalization of the output manifest
                           contents.
-check_for_duplicates      Performs a check to see if the final manifest
                           contains duplicate elements.
-nologo                    Runs without displaying standard Microsoft copyright
                           data. This may be used to suppress unwanted output
                           in log files when running mt as part of a build
                           process or from a build environment.
Samples:
-------

> To update the hash of an XML manifest:
mt -manifest 1.manifest -hashupdate -out:updated.manifest

> To update the hash of an XML manifest while simultaneously producing the .cdf file:
mt -manifest 1.manifest -hashupdate -makecdfs -out:updated.manifest

> To merge two manifests:
mt -manifest 1.manifest 2.manifest -out:merged.manifest

> To merge two manifests and finally update the hash to produce the final merged manifest. 

> Note: The searchpath for the actual files specified in the file elements is specified explicitly.
mt -manifest 1.manifest 2.manifest -hashupdate:d:\filerepository -out:merged.manifest

> To generate a manifest from an RGS and/or TLB file:
mt -rgs:MSClus.rgs -tlb:MSClus.tlb -dll:foo.dll -replacements:replacements.manifest -identity:"type=win32, name=Microsoft.Tools.SampleAssembly, version=6.0.0.0, processorArchitecture=x86, publicKeyToken=6595b64144ccf1df" -out:rgstlb.manifest

> To generate an XML manifest from a managed assembly:
mt -managedassemblyname:managed.dll -out:out.manifest

> To suppress dependencies:
mt -managedassemblyname:managed.dll -nodependency -out:out.manifest

> To extract manifest out of a dll:
mt -inputresource:dll_with_manifest.dll;#1 -out:extracted.manifest

> To merge two manifests, one of them embedded in a dll, and embedding final merged manifest into another dll's resource:
mt -inputresource:dll_with_manifest.dll;#1 -manifest 2.manifest -outputresource:dll_with_merged_manifest.dll;#3

> To update the manifest in a PE's resource (by updating the hashes of the file elements): 
mt -updateresource:dll_with_manifest.dll;#1 -hashupdate:f:\files

> To validate the hash values of all the file elements:
mt -manifest 1.manifest -validate_file_hashes:"c:\files"

> To validate a manifest (i.e., to see if it conforms to the manifest schema):
mt -manifest 1.manifest -validate_manifest

> To do a C14N canonicalization of a manifest (in order to get rid of spurious namespace prefixes (like "dsig")):
mt -manifest 1.manifest -canonicalize

> To check for duplicate elements in a manifest:
mt -manifest 1.manifest -check_for_duplicates
</pre>

