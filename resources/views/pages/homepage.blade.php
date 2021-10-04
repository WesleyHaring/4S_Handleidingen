@extends('layouts.default')

@section('introduction_text')
    <p>{{ __('introduction_texts.homepage_line_1') }}</p>
    <p>{{ __('introduction_texts.homepage_line_2') }}</p>
    <p>{{ __('introduction_texts.homepage_line_3') }}</p>
@endsection

@section('content')
    <div class="containerFavoriteBrands">
        <H1> 10 meest bekeken handleidingen.</H1>
        <div class="favoriteBrands">
            <p> Brand : Type</p>
        </div>
    </div>

    <!-- @foreach ($manuals as $manual)
		@php
            $manual->counter += 1;
            $manual->save();
        @endphp
		@if ($manual->locally_available)
			<button class="homepageButton"><a href="/{{ $brand->id }}/{{ $brand->name_url_encoded }}/{{ $type->id }}/{{ $type->name_url_encoded }}/{{ $manual->id }}/" alt="{{ __('misc.view_manual_alt') }}" title="{{ __('misc.view_manual_alt') }}">{{ __('misc.view_manual') }}</a></button> 
			({{$manual->filesize_human_readable}})
		@else
			<button class="homepageButton"><a href="{{ $manual->url }}" target="new" alt="{{ __('misc.download_manual_alt') }}" title="{{ __('misc.download_manual_alt') }}">{{ __('misc.download_manual') }}</a></button>
		@endif
		
		<br />
	@endforeach -->
    
    <h1>
        @section('title')
            {{ __('misc.all_brands') }}
        @show
    </h1>

    <?php
    $size = count($brands);
    $columns = 3;
    $chunk_size = ceil($size / $columns);
    ?>

    <div class="container">
        <!-- Example row of columns -->
        <div class="row">

            @foreach($brands->chunk($chunk_size) as $chunk)
                <div class="col-md-4">

                    <ul>
                        @foreach($chunk as $brand)

                            <?php
                            $current_first_letter = strtoupper(substr($brand->name, 0, 1));

                            if (!isset($header_first_letter) || (isset($header_first_letter) && $current_first_letter != $header_first_letter)) {
                                echo '</ul>
						<h2>' . $current_first_letter . '</h2>
						<ul>';
                            }
                            $header_first_letter = $current_first_letter
                            ?>

                            <li>
                                <a class="homepageButton" href="/{{ $brand->id }}/{{ $brand->name_url_encoded }}/">{{ $brand->name }}</a>
                            </li>
                        @endforeach
                    </ul>

                </div>
                <?php
                unset($header_first_letter);
                ?>
            @endforeach

        </div>

    </div>

@endsection
