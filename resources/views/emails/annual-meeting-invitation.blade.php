<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kallelse till årsmöte 2026</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #374151;
            background-color: #f9fafb;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        }
        .header {
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .logo {
            color: #FF2D20;
            font-weight: bold;
            font-size: 24px;
        }
        .content {
            margin-bottom: 20px;
        }
        .details-box {
            background-color: #f3f4f6;
            padding: 15px;
            border-radius: 6px;
            margin: 15px 0;
        }
        .footer {
            border-top: 1px solid #e5e7eb;
            padding-top: 20px;
            font-size: 14px;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">Laravel Sweden</div>
        </div>

        <div class="content">
            <p>Hej {{ $member->name }},</p>

            <p>Härmed kallas du till årsmöte i Swedish Laravel Association.</p>

            <div class="details-box">
                <p><strong>Datum:</strong> Tisdag 18 augusti 2026</p>
                <p><strong>Tid:</strong> 19:00–20:00</p>
                <p><strong>Plats:</strong> Digitalt via Google Meet: <a href="https://meet.google.com/crd-tyqi-xzb">https://meet.google.com/crd-tyqi-xzb</a></p>
            </div>

            <h3>Dagordning (enligt föreningens stadgar §7)</h3>
            <ol>
                <li>Val av mötesordförande, sekreterare och justerare</li>
                <li>Verksamhetsberättelse och ekonomisk redovisning</li>
                <li>Revisionsberättelse</li>
                <li>Fråga om ansvarsfrihet för styrelsen</li>
                <li>Fastställande av medlemsavgift</li>
                <li>Val av ny styrelse</li>
                <li>Övriga frågor</li>
            </ol>

            <p><strong>Motioner:</strong> Vill du lyfta en fråga eller ett förslag till årsmötet? Skicka din motion till styrelsen så snart som möjligt, senast 11 augusti 2026.</p>

            <p><strong>Anmälan:</strong> Meddela gärna om du planerar att delta, så vi får en uppfattning om antalet deltagare.</p>

            <p>Väl mött!</p>

            <p>
                Med vänliga hälsningar,<br>
                Styrelsen genom Mikko Lauhakari<br>
                Ordförande, Swedish Laravel Association
            </p>
        </div>

        <div class="footer">
            <p>Detta mejl skickades till dig eftersom du är registrerad medlem hos Swedish Laravel Association.</p>
            <p>&copy; {{ date('Y') }} Swedish Laravel Association</p>
        </div>
    </div>
</body>
</html>
