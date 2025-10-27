@extends('layouts.admin.app')

@section('title', 'WFH')

@section('content')
  <div class="mx-auto mt-6">
    @include('components.header', ['header' => 'Employee On WFH'])
    
    <!-- Search form -->
    <div class="flex justify-end mb-4">
      <form action="{{ route('user.employees.index') }}" method="GET" class="flex items-center gap-2">
        <input 
            type="text" 
            name="search" 
            value="{{ $search }}" 
            placeholder="Search employees..." 
            class="border border-gray-300 rounded px-3 py-1"
        />
        <button type="submit" class="btn btn-primary">Search</button>
      </form>
    </div>
    
    @include('components.wfh.wfh-list')
  </div>
@endsection
