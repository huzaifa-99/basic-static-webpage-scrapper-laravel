@extends('layouts.admin')

@section('content')
<div class="page-wrapper mdc-toolbar-fixed-adjust">
<main class="content-wrapper">
<div class="mdc-layout-grid">
<div class="mdc-layout-grid__inner">




<!-- The Table Start-->
<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
  <div class="mdc-card p-0">
  <div style="padding-bottom: 10px;">
    <div style="width: 90%;float: left;">
      <h6 class="card-title card-padding pb-0">Articles</h6>
    </div>
    <a href="/articles/new" style="color: black;">
    <div style="width: 10%;float: left;padding-top: 25px;">
      Add&nbsp;
      <button class="mdc-button mdc-button--raised icon-button filled-button--warning mdc-ripple-upgraded" style="--mdc-ripple-fg-size:21px; --mdc-ripple-fg-scale:2.90056; --mdc-ripple-fg-translate-start:5.625px, 10.5px; --mdc-ripple-fg-translate-end:7.5px, 7.5px;">
              <i class="material-icons mdc-button__icon">add</i>
            </button>
    </div>
    </a>
  </div>
      <div class="table-responsive">
      <table class="table table-hoverable" id="articlesTable">
        <thead>
          <tr>
            <th class="text-left" style="white-space: pre-line;vertical-align: top;max-width: 80px;">Newspaper</th>
            <th class="text-left" style="white-space: pre-line;vertical-align: top;max-width: 200px;">Title</th>
            <!-- <th class="text-left" style="white-space: pre-line;vertical-align: top;">Body</th> -->
            <!-- <th class="text-left" style="white-space: pre-line;vertical-align: top;">Thumbnail</th> -->
            <!-- <th class="text-left" style="white-space: pre-line;vertical-align: top;">Link</th> -->
            <th class="text-left" style="white-space: pre-line;vertical-align: top;">Polarity</th>
            <th class="text-left" style="white-space: pre-line;vertical-align: top;">Views</th>
            <th class="text-left" style="white-space: pre-line;vertical-align: top;">Publisher</th>
            <th class="text-left" style="white-space: pre-line;vertical-align: top;">PublishedOn</th>
            <!-- <th class="text-left" style="white-space: pre-line;vertical-align: top;">Times-Updated</th>
            <th class="text-left" style="white-space: pre-line;vertical-align: top;">Added-On</th>
            <th class="text-left" style="white-space: pre-line;vertical-align: top;">Last-Updated</th> -->
          </tr>
        </thead>
        <tbody>
          @foreach ($articles as $article)
          <tr>
            <td class="text-left columnstyles" style="max-width: 20px;white-space: pre-line;">{{ $article->newspaper_id }}</td>
            <td class="text-left columnstyles" style="max-width: 200px;white-space: pre-line;" onclick="toggleDisplay()">{{ $article->title }}&ensp;<a href="{{ $article->link }}" target="_blank">Link</a></td>
            <!-- <td class="text-left columnstyles">{{ $article->body }}</td> -->
           <!--  <td class="text-left columnstyles" id="{{ $article->id }}" onclick="picturePerfect()"><img height="50" width="80" src="{{ $article->thumbnail }}"></td> -->
            <!-- <td class="text-left columnstyles"><a href="{{ $article->link }}">{{ $article->link }}</a></td> -->
            <td class="text-left columnstyles">{{ $article->polarity }}</td>
            <td class="text-left columnstyles">{{ $article->views }}</td>
            <td class="text-left columnstyles">{{ $article->publisher }}</td>
            <!-- <td class="text-left columnstyles">
              <form method="post" action="/article/{{ $article->id }}/togglestatus" style="display: block;">
                @csrf
                <input type="hidden" name="articleId" value="{{ $article->id }}">
                @if($article->is_active==1)
                <input type="hidden" name="toggler" value="{{ $article->is_active }}">
                <button type="submit" style="border:none;border-radius:3px;outline:none;background: transparent;background-color:#a4e0ae;color: black;padding:10px;padding-top: 3px;padding-bottom: 3px;">Block</button>

                @elseif($article->is_active==0)
                <input type="hidden" name="toggler" value="{{ $article->is_active }}">
                <button type="submit" style="border:none;border-radius:3px;outline:none;background: transparent;background-color:#a4e0ae;color: black;padding:10px;padding-top: 3px;padding-bottom: 3px;">Unblock</button>
                @endif
                </form>
                <button type="submit" style="margin-top:1px;display:block;border:none;border-radius:3px;outline:none;background: transparent;background-color:#a4e0ae;color: black;padding:10px;padding-top: 3px;padding-bottom: 3px;" onclick="toggleDisplay2({!!$article->id!!},'{!!$article->name!!}','{!!$article->link!!}','{!!$article->infoDomain!!}')">Edit</button>
                <form action="/article/{{$article->id}}/delete" method="post">
                  @csrf
                <button type="submit" style="margin-top:1px;border:none;border-radius:3px;outline:none;background: transparent;background-color:#a4e0ae;color: black;padding:10px;padding-top: 3px;padding-bottom: 3px;">Delete</button>
                </form>
            </td> -->
            <td class="text-left columnstyles">{{ $article->published_on }}</td>
            <!-- <td class="text-left columnstyles">{{ $article->created_at }}</td>
            <td class="text-left columnstyles">{{ $article->updated_at }}</td> -->
          </tr> 
          @endforeach
         </tbody>
      </table>
    </div>
  </div>
</div>
<!-- The Table End -->















</div> 
</div>
</main>
<footer>
<div class="mdc-layout-grid">
<div class="mdc-layout-grid__inner">
<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
<span class="tx-14">Copyright © 2019 <a href="https://www.bootstrapdash.com/" target="_blank">BootstrapDash</a>. All rights reserved.</span>
</div>
<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop d-flex justify-content-end">
<div class="d-flex align-items-center">
<a href="">Documentation</a>
<span class="vertical-divider"></span>
<a href="">FAQ</a>
</div>
</div>
</div>
</div>
</footer>
</div>

<!-- The Popup Window -->
<div id="popup" style="position: absolute;display: none;text-align: center;top: 0.2%;z-index: 99999;margin-left: 25px;">
<div>
<!-- Cross Button Start -->

<!-- Cross Button End -->
<!-- Popup for reading Start -->
  <div style="position:fixed;border:1px solid lightgrey;border-radius: 3px; padding: 0px;background:#fff;width: 80%;height:800px;padding: 50px;overflow-y: auto;">


            <div style="float: right;text-align: right;">
              <div style="font-size: 25px; cursor: pointer;" onclick="toggleDisplay()">
                  <i class="fas fa-times"></i>
              </div>
            </div>
            
            @foreach($articles as $article)

            {{$article->body}}

            @endforeach

  </div>
<!-- Popup for reading End -->
</div>
</div>
<!-- The Popup Window -->
@endsection