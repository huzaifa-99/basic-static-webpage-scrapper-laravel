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
      <h6 class="card-title card-padding pb-0">Broken Articles</h6>
    </div>
    <div style="width: 10%;float: left;padding-top: 25px;" onclick="toggleDisplay()">
      Add nodes&nbsp;
      <button class="mdc-button mdc-button--raised icon-button filled-button--warning mdc-ripple-upgraded" style="--mdc-ripple-fg-size:21px; --mdc-ripple-fg-scale:2.90056; --mdc-ripple-fg-translate-start:5.625px, 10.5px; --mdc-ripple-fg-translate-end:7.5px, 7.5px;">
              <i class="material-icons mdc-button__icon">add</i>
            </button>
    </div>
  </div>
      <div class="table-responsive">
      <table class="table table-hoverable" id="articlesTable">
        <thead>
          <tr>
            <th class="text-left" style="white-space: pre-line;vertical-align: top;max-width: 80px;">Newspaper</th>
            <th class="text-left" style="white-space: pre-line;vertical-align: top;max-width: 200px;">Title</th>
            <th class="text-left" style="white-space: pre-line;vertical-align: top;">Body</th>
            <th class="text-left" style="white-space: pre-line;vertical-align: top;">Thumbnail</th>
            <th class="text-left" style="white-space: pre-line;vertical-align: top;">Link</th>
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
            <td class="text-left columnstyles" style="max-width: 200px;white-space: pre-line;">{{ $article->title }}&ensp;<a href="{{ $article->link }}" target="_blank">Link</a></td>
            <!-- <td class="text-left columnstyles" style="white-space: pre-line;max-width: 550px;">{{ $article->body }}</td> -->
            <td class="text-left columnstyles" id="{{ $article->id }}" onclick="picturePerfect()"><img height="50" width="80" src="{{ $article->thumbnail }}"></td>
            <td class="text-left columnstyles"><a href="{{ $article->link }}" target="_blank">{{ $article->link }}</a></td>
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




<!-- The Popup Window -->
<div id="popup" style="position: absolute;display: none;text-align: center;top: 5%;left: 25%;z-index: 99999;">
<div style="width: 700px;height: 500px;">
<!-- Cross Button Start -->
<div>
  <div style="float: right;width: 100%;position:absolute;text-align: right;">
    <div style="padding: 25px;cursor: pointer;" onclick="toggleDisplay()">
        <i class="fas fa-times"></i>
    </div>
  </div>
</div>
<!-- Cross Button End -->
<!-- Form Start -->
<form id="newspaper-nodes" action="/newspaper-nodes" method="post" enctype="multipart/form-data">
  @csrf

  <div class="mdc-layout-grid" style="border:1px solid lightgrey;border-radius: 3px; padding: 0px;">
        <div class="mdc-layout-grid__inner">
          <div class="mdc-layout-grid__cell--span-12">
            <div class="mdc-card">
              <h6 class="card-title">Add Nodes</h6>
<!--  --> 
              <div class="template-demo">
                <div class="mdc-layout-grid__inner">



                  <!-- Domain Field -->
                  <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="margin-left: 15%;margin-right: 15%;margin-bottom: 10px;">
                    <div class="mdc-text-field" data-mdc-auto-init="MDCSelect" style="background-color: white;border:1px solid #ddd;">
                      <input type="hidden" name="newswire">
                      <i class="mdc-select__dropdown-icon"></i>
                      <div class="mdc-select__selected-text" style="text-align: left;"></div>
                      <div class="mdc-select__menu mdc-menu-surface demo-width-class" style="z-index: 99999;">
                        <ul class="mdc-list" id="container">
                          @foreach($newsline as $news)
                          <li class="mdc-list-item" data-value="{{$news->name}}" class="choiceBox" >
                            {{$news->name}}
                          </li>
                          @endforeach
                        </ul>
                      </div>
                      <span class="mdc-floating-label">Newspaper</span>
                      <div class="mdc-line-ripple"></div>
                    </div>
                  </div>

                  <div id="newswire-error-dialog" class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="display:none;margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div id="newswire-error" style="color: red;">
                      
                    </div>
                  </div>

                  <!-- Domain Field -->



                  <!-- Domain Field -->
                  <!-- <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div class="mdc-text-field" data-mdc-auto-init="MDCSelect" style="background-color: white;border:1px solid #ddd;">
                      <input type="hidden" name="domain" >
                      <i class="mdc-select__dropdown-icon"></i>
                      <div class="mdc-select__selected-text" style="text-align: left;"></div>
                      <div class="mdc-select__menu mdc-menu-surface demo-width-class" style="z-index: 99999;">
                        <ul class="mdc-list" id="container">
                          <li class="mdc-list-item" data-value="all" id="choiceBox" >
                            Title
                          </li>
                          <li class="mdc-list-item" data-value="political" id="choiceBox1" >
                            Body
                          </li>
                          <li class="mdc-list-item" data-value="bussiness" id="choiceBox2" >
                            Thumbnail
                          </li>
                          <li class="mdc-list-item" data-value="sports" id="choiceBox3" >
                            Publisher
                          </li>
                          <li class="mdc-list-item" data-value="technology" id="choiceBox4" >
                            Publish Date
                          </li>
                        </ul>
                      </div>
                      <span class="mdc-floating-label">Node For</span>
                      <div class="mdc-line-ripple"></div>
                    </div>
                  </div>

                  <div id="domain-error-dialog" class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="display:none;margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div id="domain-error" style="color: red;">
                      
                    </div>
                  </div> -->

                  <!-- Domain Field -->

                 

                  <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="display:block;margin-left: 15%;margin-right: 15%;margin-bottom: 5px;">

                    <div>
                      <h4 style="text-align: left;float: left;">Add Nodes</h4>
                    </div>
                    <div style="text-align: left;float: left;">
                      <p>You can add multiple nodes seperated with a comma ','<p> 
                    </div>

                  </div>


                  <!-- Title Field -->
                  <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div class="mdc-text-field mdc-text-field--outlined">
                      <input class="mdc-text-field__input" name="title" id="text-field-hero-input1" >
                      <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                        <div class="mdc-notched-outline__leading"></div>
                        <div class="mdc-notched-outline__notch" style="">
                          <label for="text-field-hero-input1" class="mdc-floating-label" style="">Title</label>
                        </div>
                        <div class="mdc-notched-outline__trailing"></div>
                      </div>
                    </div>
                  </div>

                  <div id="title-error-dialog" class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="display:none;margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div id="title-error" style="color: red;">

                    </div>
                  </div>
                 <!-- Title Field -->

                 <!-- Body Field -->
                  <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div class="mdc-text-field mdc-text-field--outlined">
                      <input class="mdc-text-field__input" name="body" id="text-field-hero-input2" >
                      <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                        <div class="mdc-notched-outline__leading"></div>
                        <div class="mdc-notched-outline__notch" style="">
                          <label for="text-field-hero-input2" class="mdc-floating-label" style="">Body</label>
                        </div>
                        <div class="mdc-notched-outline__trailing"></div>
                      </div>
                    </div>
                  </div>

                  <div id="body-error-dialog" class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="display:none;margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div id="body-error" style="color: red;">
                      
                    </div>
                  </div>

                  <!-- Body Field -->

                  <!-- Thumbnail Field -->
                  <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div class="mdc-text-field mdc-text-field--outlined">
                      <input class="mdc-text-field__input" name="thumbnail" id="text-field-hero-input2" >
                      <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                        <div class="mdc-notched-outline__leading"></div>
                        <div class="mdc-notched-outline__notch" style="">
                          <label for="text-field-hero-input2" class="mdc-floating-label" style="">Thumbnail</label>
                        </div>
                        <div class="mdc-notched-outline__trailing"></div>
                      </div>
                    </div>
                  </div>

                  <div id="thumbnail-error-dialog" class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="display:none;margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div id="thumbnail-error" style="color: red;">
                      
                    </div>
                  </div>

                  <!-- Thumbnail Field -->



                  <!-- Publisher Field -->
                  <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div class="mdc-text-field mdc-text-field--outlined">
                      <input class="mdc-text-field__input" name="publisher" id="text-field-hero-input2" >
                      <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                        <div class="mdc-notched-outline__leading"></div>
                        <div class="mdc-notched-outline__notch" style="">
                          <label for="text-field-hero-input2" class="mdc-floating-label" style="">Publisher</label>
                        </div>
                        <div class="mdc-notched-outline__trailing"></div>
                      </div>
                    </div>
                  </div>

                  <div id="publisher-error-dialog" class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="display:none;margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div id="publisher-error" style="color: red;">
                      
                    </div>
                  </div>

                  <!-- Publisher Field -->

                  <!-- Published_on Field -->
                  <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div class="mdc-text-field mdc-text-field--outlined">
                      <input class="mdc-text-field__input" name="published_on" id="text-field-hero-input2" >
                      <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                        <div class="mdc-notched-outline__leading"></div>
                        <div class="mdc-notched-outline__notch" style="">
                          <label for="text-field-hero-input2" class="mdc-floating-label" style="">Published On</label>
                        </div>
                        <div class="mdc-notched-outline__trailing"></div>
                      </div>
                    </div>
                  </div>

                  <div id="published_on-error-dialog" class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="display:none;margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div id="published_on-error" style="color: red;">
                      
                    </div>
                  </div>

                  <!-- Published_on Field -->
                  
                 

                  <!-- Submit Button -->
                  <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="margin-left: 15%;margin-right: 15%;padding-bottom: 25px;margin-top: 20px;">
                      <input type="submit" class="mdc-button mdc-button--raised w-100 mdc-ripple-upgraded" style="--mdc-ripple-fg-size:247px; --mdc-ripple-fg-scale:1.7199; --mdc-ripple-fg-translate-start:36.1875px, -119px; --mdc-ripple-fg-translate-end:83.125px, -105.5px;" value="Add">
                   </div>
                  <!-- Submit Button -->

                  

                </div>
              </div>
<!--  -->
            </div>
          </div>
        </div>
  </div>
</form>
<!-- Form End -->
</div>
</div>
<!-- The Popup Window -->










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
@endsection
