<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; color: #333; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #0a192f; color: #c5b48c; padding: 20px; text-align: center; }
        .content { padding: 20px; background-color: #f9f9f9; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 10px; border-bottom: 1px solid #ddd; text-align: left; }
        th { background-color: #efe8d5; color: #0a192f; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>W.D.V. Schickerling</h1>
            <p>Daily Request Summary</p>
        </div>
        <div class="content">
            <h2>New Requests for {{ now()->format('d M Y') }}</h2>
            
            @if($requests->isEmpty())
                <p>There were no new service requests submitted today.</p>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Service</th>
                            <th>Email</th>
                            <th>Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($requests as $req)
                            <tr>
                                <td>{{ $req->name }}</td>
                                <td>{{ $req->service }}</td>
                                <td>{{ $req->email }}</td>
                                <td>{{ $req->phone }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</body>
</html>