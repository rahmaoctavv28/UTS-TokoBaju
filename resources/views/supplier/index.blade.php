    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI',sans-serif;
        }

        body{
            background:#eef2f7;
            padding:40px;
        }

        .container{
            background:white;
            border-radius:25px;
            padding:40px;
            box-shadow:0 15px 35px rgba(0,0,0,0.1);
        }

        .header{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:30px;
            flex-wrap:wrap;
        }

        .title{
            display:flex;
            align-items:center;
            gap:15px;
        }

        .title h1{
            color:#183153;
            font-size:48px;
            font-weight:800;
        }

        .actions{
            display:flex;
            gap:15px;
        }

        .btn{
            text-decoration:none;
            color:white;
            padding:15px 25px;
            border-radius:15px;
            font-size:20px;
            font-weight:bold;
        }

        .btn-add{
            background:#3465e1;
        }

        .btn-home{
            background:#4b5c77;
        }

        .alert{
            background:#d1fae5;
            color:#065f46;
            padding:15px;
            border-radius:10px;
            margin-bottom:20px;
            font-weight:bold;
        }

        table{
            width:100%;
            border-collapse:collapse;
            overflow:hidden;
            border-radius:20px;
        }

        th{
            background:#1f2a44;
            color:white;
            padding:18px;
            font-size:18px;
        }

        td{
            padding:15px;
            text-align:center;
            border-bottom:1px solid #e5e7eb;
        }

        tr:hover{
            background:#f8fafc;
        }

        .edit{
            background:#f59e0b;
            color:white;
            text-decoration:none;
            padding:10px 15px;
            border-radius:10px;
            font-weight:bold;
        }

        .hapus{
            background:#dc2626;
            color:white;
            border:none;
            padding:10px 15px;
            border-radius:10px;
            font-weight:bold;
            cursor:pointer;
        }

        form{
            display:inline;
        }

    </style>

</head>
<body>

<div class="container">

    <div class="header">

        <div class="title">
            <h1>🏢 Data Supplier</h1>
        </div>

        <div class="actions">

            <a href="/supplier/create" class="btn btn-add">
                + Tambah Supplier
            </a>

            <a href="/gudang" class="btn btn-home">
                🏠 Dashboard Gudang
            </a>

        </div>

    </div>

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    <table>

        <thead>

            <tr>
                <th>ID</th>
                <th>Nama Supplier</th>
                <th>No HP Supplier</th>
                <th>Alamat Perusahaan</th>
                <th>Jenis Barang</th>
                <th>Edit</th>
                <th>Hapus</th>
            </tr>

        </thead>

        <tbody>

        @forelse($supplier as $s)

            <tr>

                <td>{{ $s->id }}</td>

                <td>{{ $s->nama_supplier }}</td>

                <td>{{ $s->no_hp }}</td>

                <td>{{ $s->alamat }}</td>

                <td>{{ $s->kota }}</td>

                <td>

                    <a href="/supplier/{{ $s->id }}/edit"
                       class="edit">

                       ✏ Edit

                    </a>

                </td>

                <td>

                    <form action="/supplier/{{ $s->id }}"
                          method="POST">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="hapus"
                                onclick="return confirm('Yakin ingin menghapus supplier ini?')">

                            🗑 Hapus

                        </button>

                    </form>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="7">

                    Data supplier masih kosong

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>
