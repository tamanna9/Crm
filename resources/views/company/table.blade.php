<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
  <thead>
    <tr>
      <th class="center"> {{ __('Sr.No') }} </th>
      <th class="center"> {{ __('Name') }} </th>
      <th class="center"> {{ __('Website') }} </th>
      <th class="center"> {{ __('Address') }} </th>
      <th class="center">{{ __('Email') }}  </th>
      <th class="center"> {{ __('Actions') }} </th>
    </tr>
  </thead>
  <tbody>
    @if(count($companies))
    @php $itr = 1;@endphp
    @foreach($companies as $company)
    <tr>
      <td> {{$itr}}</td>
      <td> {{$company->name ?? '-'}}</td>
      <td> {{$company->website ?? '-'}}</td>
      <td> {{$company->address ?? '-'}}</td>
      <td> {{$company->email ?? '-'}}</td>
      <td class="center">
        <a class="edit" href="" id="edit-company" data-id="{{$company->id}}">{{ __('Edit') }} </a> 
        <a class="view" href="" id="delete-company" data-id="{{$company->id}}">{{ __('Delete') }}</a>
      </td>
      @php $itr++;@endphp
    </tr>
    @endforeach
    @else
    <tr>
      <td colspan="6">
        No record found
      </td>
    </tr>
    @endif
  </tbody>
</table>
<div class="row">
  <div class="col-md-6">
    @if(isset($companies))
    <div class="">
      {{$companies->links()}}
    </div>
    @endif
  </div>
</div>