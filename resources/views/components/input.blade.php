<input  type="{{ $type }}" {{ $attributes->merge(['class' => $type == 'submit' ? 'btn btn-primary btn-sm text-bold float-sm-right' : 'form-control']) }} name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder ?? ' ' }}" >