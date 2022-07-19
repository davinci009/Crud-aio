@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">
          <div class="d-flex  justify-content-between">
            {{ __('Products') }}
            @isset($product)
              <a class="btn btn-warning" href="{{route('products.index')}}">Nuevo</a>
            @endif
          </div>
        </div>

        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('status') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
          
          @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <div>{{ $error }}</div>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endforeach

          <div class="row">
           
          </div>

          <div class="row">
             <div class="col-4">
              <form action="{{route('products.store')}}" method="post">
                @csrf

                @isset($product)
                  <input name="id" type="hidden" value="{{$product->id}}">
                @endisset
                  
                <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control" id="name" name="name" aria-describedby="name"
                    @isset($product) value="{{$product->name}}" @endisset autofocus
                  >
                </div>

                <div class="mb-3">
                  <label for="description" class="form-label">Description</label>
                  <input type="text" class="form-control" id="description" name="description"
                    @isset($product) value="{{$product->description}}" @endisset
                  >
                </div>

                <div class="mb-3">
                  <label class="form-label" for="price">Price</label>
                  <input type="number" min="0" class="form-control" id="price" name="price"
                    @isset($product) value="{{$product->price}}" @endisset
                  >
                </div>

                 <div class="mb-3">
                  <label class="form-label" for="qty">Qty</label>
                  <input type="number" min="0" class="form-control" id="qty" name="qty"
                    @isset($product) value="{{$product->qty}}" @endisset
                  >
                </div>

                <button type="submit" class="btn btn-primary">
                  @if($product)
                    Guardar
                  @else
                    Crear
                  @endif
                </button>
              </form>
            </div>
            <div class="col-8">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Actions</th>

                  </tr>
                </thead>
                <tbody>
                  @foreach ($products as $product)
                    <tr>
                      <th scope="row">{{$product->id}}</th>
                      <td>{{$product->name}}</td>
                      <td>{{$product->description}}</td>
                      <td>{{$product->price}}</td>
                      <td>{{$product->qty}}</td>
                      <td><a href="{{route('products.edit', ['product' => $product->id])}}" class="btn btn-primary">Editar</a></td>
                      <td>
                        <form action="{{route('products.destroy', [ 'product' => $product->id ])}}" method="post">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
