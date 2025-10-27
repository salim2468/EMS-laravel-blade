<aside id="sidebar" class="bg-dark-primary  text-white h-full w-full sm:w-64 shadow-md absolute z-50 md:relative md:translate-x-0 -translate-x-full transition-transform duration-300 ease-in-out">
  <div class="flex justify-between items-center p-4 border-b">
    <div class="font-bold">
      {{ auth()->user()->email }}
    </div>
    <i class="fa-regular fa-circle-xmark fa-xl cursor-pointer sidebar-btn md:hidden"></i>
  </div>
  <ul class="p-4 space-y-2">
    <li>
      <a href="/" class="block hover:bg-blue-900 px-4 py-2 rounded">Dashboard</a>
    </li>

    <li>
      <a href="{{ route('user.employees.index') }}" class="block hover:bg-blue-900 px-4 py-2 rounded">
        Employees
      </a>
    </li>

    <li>
      <a href="{{ route('user.leave-employees') }}" class="block px-4 py-2 hover:bg-blue-900 rounded">
        Employee On Leave
      </a>
    </li>

    <li>
      <a href="{{ route('user.leaves.create') }}" class="block hover:bg-blue-900 px-4 py-2 rounded">Apply Leave</a>
    </li>

    <li>
      <a href="{{ route('user.leaves.leave-report') }}" class="block hover:bg-blue-900 px-4 py-2 rounded">Leave Report</a>
    </li>

    @role('manager')
    <li>
      <a href="{{ route('user.leaves.request') }}" class="block hover:bg-blue-900 px-4 py-2 rounded">Leave Request</a>
    </li>
    @endrole

    @role('manager')
    <li>
      <a href="{{ route('user.wfh.create') }}" class="block px-4 py-2 hover:bg-blue-900 rounded">
        Create WFH
      </a>
    </li>
    @endrole

    <li>
      <a href="{{ route('user.wfh.index') }}" class="block px-4 py-2 hover:bg-blue-900 rounded">
        Employee On WFH
      </a>
    </li>
  </ul>
</aside>