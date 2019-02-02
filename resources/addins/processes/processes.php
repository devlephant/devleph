<?
global $FFI_DIONIX_kernel32,$FFI_DIONIX_ntdll; 
$FFI_DIONIX_kernel32 = new FFI(" [lib='kernel32.dll'] 
        sint8 CloseHandle( int handle ); 
        int OpenProcess(int dwDesiredAccess, sint8 bInheritHandle, int processId); 
"); 

$FFI_DIONIX_ntdll = new FFI(" [lib='ntdll.dll'] 
        int NtResumeProcess( int processHandle ); 
        int NtSuspendProcess( int processHandle ); 
"); 

function OpenProcess_($dwDesiredAccess,$bInheritHandle,$processId){ 
    global $FFI_DIONIX_kernel32; 
    switch($dwDesiredAccess){ 
    case 1: 
    $dwDesiredAccess = 0x800; // Required to suspend or resume a process. 
    break; 
    case 2: 
    $dwDesiredAccess = 0x1; // Required to terminate a process using TerminateProcess. 
    break; 
    case 3: 
    $dwDesiredAccess = 0x2; // Required to create a thread. 
    break; 
    case 4: 
    $dwDesiredAccess = 0x4; // Undocumented. 
    break; 
    case 5: 
    $dwDesiredAccess = 0x8; // Required to perform an operation on the address space of a process (see VirtualProtectEx and WriteProcessMemory). 
    break; 
    case 6: 
    $dwDesiredAccess = 0x10; // Required to read memory in a process using ReadProcessMemory. 
    break; 
    case 7: 
    $dwDesiredAccess = 0x20; // Required to write to memory in a process using WriteProcessMemory. 
    break; 
    case 8: 
    $dwDesiredAccess = 0x40; // Required to duplicate a handle using DuplicateHandle. 
    break; 
    case 9: 
    $dwDesiredAccess = 0x80; // Required to create a process. 
    break; 
    case 10: 
    $dwDesiredAccess = 0x100; // Required to set memory limits using SetProcessWorkingSetSize. 
    break; 
    case 11: 
    $dwDesiredAccess = 0x200; // Required to set certain information about a process, such as its priority class (see SetPriorityClass). 
    break; 
    case 12: 
    $dwDesiredAccess = 0x400; // Required to retrieve certain information about a process, such as its token, exit code, and priority class (see OpenProcessToken, GetExitCodeProcess, GetPriorityClass, and IsProcessInJob). 
    break; 
    case 13: 
    $dwDesiredAccess = 0x1000; // Required to retrieve certain information about a process (see QueryFullProcessImageName). A handle that has the PROCESS_QUERY_INFORMATION access right is automatically granted PROCESS_QUERY_LIMITED_INFORMATION. 
    break; 
    case 14: 
    $dwDesiredAccess = 0x100000; // Required to wait for the process to terminate using the wait functions. 
    break; 
    } 
    $result = $FFI_DIONIX_kernel32->OpenProcess($dwDesiredAccess,$bInheritHandle,$processId); 
    return $result; 
} 

function CloseHandle_($handle){ 
    global $FFI_DIONIX_kernel32; 
    return $FFI_DIONIX_kernel32->CloseHandle($handle); 
} 
function NtResumeProcess_($processHandle){ 
    global $FFI_DIONIX_ntdll; 
    return $FFI_DIONIX_ntdll->NtResumeProcess($processHandle); 
} 
function NtSuspendProcess_($processHandle){ 
    global $FFI_DIONIX_ntdll; 
    return $FFI_DIONIX_ntdll->NtSuspendProcess($processHandle); 
} 

function Process_PidSuspend($process_pid_,$Process_Suspend){ 
for($i=0;$i<=count($process_pid_);$i++){ 
$OpenProcess = OpenProcess_(1,false, $process_pid_[$i] ); 
if($OpenProcess){ 
if($Process_Suspend==1){ 
    NtSuspendProcess_($OpenProcess); 
    CloseHandle_($OpenProcess); 
} 
elseif($Process_Suspend==2){ 
    NtResumeProcess_($OpenProcess); 
    CloseHandle_($OpenProcess); 
}}} 
}  

function sss_ddfv($name_Process){
$obj = new COM('winmgmts://localhost/root/CIMV2');
foreach($obj->ExecQuery("SELECT * FROM Win32_Process WHERE name = '$name_Process'") AS $Process){ $name_Process=$Process->ProcessId; break; }
return $name_Process;
}