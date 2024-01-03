<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $mailInfo['subject'] }}</title>

    <style>
        * {
            font-size: 1.2rem;
        }

        .container {
            padding: 1rem;
        }

        .url-link {
            text-decoration: underline;
            color: #2086bc;
        }

        .pin {
            color: #2086bc;
        }

        .schedule {
            color: rgb(206, 69, 42);
        }
    </style>
</head>

<body>
    <div class="container">
        <p>Good day, <span class="text-red-500">{{ $mailInfo['fullname'] }}</span>!</p>

        <p>
            You have been invited to take the
            <strong>{{ $mailInfo['assessmentTitle'] }}</strong>.
        </p>

        <p>
            To begin the test, please copy the following URL, open it in a
            browser, and enter the given test pin on the page.
        </p>

        <p>
            <span>URL: </span>
            <a class="url-link" href="https://teachertribe.fly.dev/test"
                target="_blank">https://teachertribe.fly.dev/test</a>
            <br />
            <span>Test PIN: </span>
            <span class="pin">{{ $mailInfo['pin'] }}</span>
        </p>

        <p>
            The above Test PIN will only be valid from
            <span class="schedule">{{ $mailInfo['schedule_from'] }}</span>
            to
            <span class="schedule">{{ $mailInfo['schedule_to'] }}</span>.
        </p>

        <p>
            All instructions regarding test coverage, duration, and format will
            be available at the start of the test.
        </p>

        <p>
            <span>Happy Coding!</span>
            <br />
            <span>- Teacher Tribe</span>
        </p>
    </div>
</body>

</html>
