@component('mail::message')

# {{ $seriesName }} criada

A série {{ $seriesName }} com {{ $seriesSeason }} temporadas e {{ $seriesEpisodes }} episódios por temporada foi criada.

Acesse aqui:

@component('mail::button', ['url' => route('seasons.index', $seriesId)])
    Ver série
@endcomponent

@endcomponent
