<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; border-top: 4px solid #b8935a; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .header { background-color: #0a192f; padding: 20px; text-align: center; }
        .header h1 { color: #c5b48c; margin: 0; font-family: Georgia, serif; font-size: 24px; }
        .content { padding: 30px; color: #333333; line-height: 1.6; }
        .details { background-color: #fcfbf7; border: 1px solid #e8e2d0; padding: 15px; margin: 20px 0; border-radius: 4px; }
        .details strong { color: #0a192f; }
        .footer { background-color: #0a192f; color: #8892b0; text-align: center; padding: 15px; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Meeting Reminder</h1>
        </div>
        <div class="content">
            <p>Good morning,</p>
            <p>This is a reminder that there is an upcoming meeting for the following estate scheduled for <strong>tomorrow</strong>.</p>
            
            <div class="details">
                <p><strong>Estate:</strong> {{ $meeting->estate_matter }}</p>
                <p><strong>Master's Number:</strong> {{ $meeting->reference }}</p>
                <p><strong>Date & Venue:</strong> {{ $meeting->date_and_venue }}</p>
                <p><strong>Next Action:</strong> {{ $meeting->next_action }}</p>
            </div>

            <p>Please ensure all necessary documents are prepared.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} W.D.V. Schickerling. All rights reserved.
        </div>
    </div>
</body>
</html>