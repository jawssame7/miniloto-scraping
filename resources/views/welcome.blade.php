<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Semantic-UI Sample</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/semantic.min.css') }}">
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
        {{-- <script src="{{ asset('js/semantic.min.js') }}"></script> --}}
        <script src="{{ asset('js/app.js') }}"></script>
    </head>
    <body>
    <div class="ui container">
        <h1>Theming Examples</h1>
        <div class="ui three column stackable grid">
            <div class="column">
                <h1>Heading 1</h1>
                <h2>Heading 2</h2>
                <h3>Heading 3</h3>
                <h4>Heading 4</h4>
                <h5>Heading 5</h5>
                <p>Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula.</p>
            </div>
            <div class="column">
                <h2>Example body text</h2>
                <p>Nullam quis risus eget <a href="#">urna mollis ornare</a> vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula.</p>
                <p><small>This line of text is meant to be treated as fine print.</small></p>
                <p>The following snippet of text is <strong>rendered as bold text</strong>.</p>
                <p>The following snippet of text is <em>rendered as italicized text</em>.</p>
                <p>An abbreviation of the word attribute is <abbr title="attribute">attr</abbr>.</p>
            </div>
            <div class="column">
                <div class="ui three column stackable padded middle aligned centered color grid">
                    <div class="red column">Red</div>
                    <div class="orange column">Orange</div>
                    <div class="yellow column">Yellow</div>
                    <div class="olive column">Olive</div>
                    <div class="green column">Green</div>
                    <div class="teal column">Teal</div>
                    <div class="blue column">Blue</div>
                    <div class="violet column">Violet</div>
                    <div class="purple column">Purple</div>
                    <div class="pink column">Pink</div>
                    <div class="brown column">Brown</div>
                    <div class="grey column">Grey</div>
                    <div class="black column">Black</div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>