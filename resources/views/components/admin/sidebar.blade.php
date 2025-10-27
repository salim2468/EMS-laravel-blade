<aside id="sidebar" class="bg-dark-primary  text-white h-full w-full sm:w-64 shadow-md absolute z-50 md:relative md:translate-x-0 -translate-x-full transition-transform duration-300 ease-in-out">
  <div class="flex justify-between items-center p-4 border-b">
    <div class="font-bold">
      Admin Menu
    </div>
    <i class="fa-regular fa-circle-xmark fa-xl cursor-pointer sidebar-btn md:hidden"></i>
  </div>
  <ul class="p-4 space-y-2">
    <li>
      <a href="{{ route('admin.dashboard') }}" class="block hover:bg-blue-900 px-4 py-2 rounded">Dashboard</a>
    </li>
    <li>
      <a href="{{ route('admin.employees.index') }}" class="block hover:bg-blue-900 px-4 py-2 rounded">Employee</a>
    </li>
    <li>
      <a href="{{ route('roles.index') }}" class="block hover:bg-blue-900 px-4 py-2 rounded">
        Roles
      </a>
    </li>
    <li>
      <a href="{{ route('permissions.index') }}" class="block px-4 py-2 hover:bg-blue-900 rounded">
        Permissions
      </a>
    </li>
    <li>
      <a href="{{ route('admin.wfh.index') }}" class="block px-4 py-2 hover:bg-blue-900 rounded">
        Employee On WFH
      </a>
    </li>
    <li>
      <a href="{{ route('user.wfh.create') }}" class="block px-4 py-2 hover:bg-blue-900 rounded">
        Create WFH
      </a>
    </li>
    <li>
      <a href="{{ route('admin.leave-types.index') }}" class="block hover:bg-blue-900 px-4 py-2 rounded">Leaves</a>
    </li>
    <li>
      <a href="{{ route('admin.leaves.request') }}" class="block hover:bg-blue-900 px-4 py-2 rounded">Leave Request</a>
    </li>
    <li>
      <a href="{{ route('admin.announcement.create') }}" class="block hover:bg-blue-900 px-4 py-2 rounded">Create Annoncement</a>
    </li>
    <li>
      <a href="/settings" class="block hover:bg-blue-900 px-4 py-2 rounded">Settings</a>
    </li>
  </ul>
</aside>