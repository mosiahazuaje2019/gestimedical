<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    </head>
<body>
    <h1>Listado de pacientes</h1>
    <table>
            <thead>
                <tr>
                    <th><strong>Nombre</strong></th>
                    <th><strong>Cédula</strong></th>
                    <th><strong>Dirección</strong></th>
                    <th><strong>Teléfono</strong></th>
                </tr>
            </thead>
            <tbody>
                @foreach($patients as $key=>$patient)
                    <tr>
                        <td>{{ $patient->first_name }} {{ $patient->last_name }}</td>
                        <td>{{ $patient->personal_id }}</td>
                        <td>{{ $patient->patient_adress[0]->name }}</td>
                        <td>{{ $patient->patient_phone[0]->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
</body>
</html>
