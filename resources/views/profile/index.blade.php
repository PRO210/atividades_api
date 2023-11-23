<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <title>{{ $title ?? 'Usuários' }} </title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!--Tailwind CSS-->
  <link rel="stylesheet" href="{{ asset('css/table.css') }}">

  {{--
  <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel=" stylesheet"> --}}
  <!--Replace with your tailwind.css once created-->

  <!--Regular Datatables CSS-->
  {{-- <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
  <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">

  <!--Responsive Extension Datatables CSS-->
  {{-- <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet"> --}}
  <link rel="stylesheet" href="{{ asset('css/responsive.dataTables.min.css') }}">

</head>

<body class="bg-gray-100 text-gray-900 tracking-wider leading-normal">

  @include('layouts.navigation')

  <!--Container-->
  <div class="container w-full md:w-4/5 xl:w-3/5  mx-auto p-4">
    <!--Card-->
    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
      <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
        <thead>
          <tr>
            <th data-priority="1">Name</th>
            <th data-priority="2">Email</th>
            <th data-priority="2">Desde</th>
            <th data-priority="2">Ações</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
          <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}</td>
            <td> <x-dropdown-link :href="
              route('profile.user.edit', $user->uuid )" class="text-decoration-none cursor-pointer inline-block" title="Editar Cadastro">
                <x-svgs.eye />
              </x-dropdown-link></td>
          </tr>
          @endforeach
          <!-- Rest of your data (refer to https://datatables.net/examples/server_side/ for server side processing)-->

        </tbody>
      </table>
    </div>
    <!--/Card-->

  </div>
  <!--/container-->

  <!-- jQuery -->
  {{-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script> --}}
  <script src="{{ url('js/jquery-3.4.1.min.js') }}" type="text/javascript"></script>

  <!--Datatables -->
  {{-- <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> --}}
  <script src="{{ url('js/jquery.dataTables.min.js') }}" type="text/javascript"></script>

  {{-- <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script> --}}
  <script src="{{ url('js/dataTables.responsive.min.js') }}" type="text/javascript"></script>

  <script>
    $(document).ready(function() {

                  var table = $('#example').DataTable({
                      responsive: true,
                      "lengthMenu": [
                      [5, 10, 15, 20, 25, 30, 35, 40, 50, 70, 100, -1],
                      [5, 10, 15, 20, 25, 30, 35, 40, 50, 70, 100, "All"]
                    ],
                      "language": {
                      "lengthMenu": " _MENU_ ",
                      "zeroRecords": "Nenhum Usuário encontrado",
                      "info": "Mostrando pagina _PAGE_ de _PAGES_",
                      "infoEmpty": "Sem registros",
                      "search": "Busca:",
                      "infoFiltered": "(filtrado de _MAX_ total de Usuários)",
                      "paginate": {
                        "first": "Primeira",
                        "last": "Ultima",
                        "next": "Proxima",
                        "previous": "Anterior"
                      },
                    },
                    })

                    .columns.adjust()
                    .responsive.recalc();
                });
  </script>

</body>
