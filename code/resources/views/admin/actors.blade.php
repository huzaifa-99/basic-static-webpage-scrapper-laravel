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
      <h6 class="card-title card-padding pb-0">Actors</h6>
    </div>
    <div style="width: 10%;float: left;padding-top: 25px;" onclick="toggleDisplay()">
      Add&nbsp;
      <button class="mdc-button mdc-button--raised icon-button filled-button--warning mdc-ripple-upgraded" style="--mdc-ripple-fg-size:21px; --mdc-ripple-fg-scale:2.90056; --mdc-ripple-fg-translate-start:5.625px, 10.5px; --mdc-ripple-fg-translate-end:7.5px, 7.5px;">
              <i class="material-icons mdc-button__icon">add</i>
            </button>
    </div>
  </div>
      <div class="table-responsive">
      <table class="table table-hoverable">
        <thead>
          <tr>
            <th class="text-left" style="white-space: pre-line;vertical-align: top;">Name</th>
            <th class="text-left" style="white-space: pre-line;vertical-align: top;">Description</th>
            <!-- <th class="text-left" style="white-space: pre-line;vertical-align: top;">Body</th> -->
            <th class="text-left" style="white-space: pre-line;vertical-align: top;">Profession</th>
            <!-- <th class="text-left" style="white-space: pre-line;vertical-align: top;">Link</th> -->
            <th class="text-left" style="white-space: pre-line;vertical-align: top;">Thumbanil</th>
            <th class="text-left" style="white-space: pre-line;vertical-align: top;">Profile-Views</th>
            <th class="text-left" style="white-space: pre-line;vertical-align: top;">Articles-Views</th>
            <th class="text-left" style="white-space: pre-line;vertical-align: top;">Appeared-In</th>
            <!-- <th class="text-left" style="white-space: pre-line;vertical-align: top;">Times-Updated</th>
            <th class="text-left" style="white-space: pre-line;vertical-align: top;">Added-On</th>
            <th class="text-left" style="white-space: pre-line;vertical-align: top;">Last-Updated</th> -->
          </tr>
        </thead>
        <tbody>
          @foreach ($actors as $actor)
          <tr>
            <td class="text-left columnstyles">{{ $actor->name }}</td>
            <td class="text-left columnstyles"><a href="{{ $actor->link }}">description</a></td>
            <td class="text-left columnstyles"><a href="{{ $actor->link }}">profession</a></td>
            <!-- <td class="text-left columnstyles">{{ $actor->body }}</td> -->
            <td class="text-left columnstyles" >thumbnail
              <!-- <img height="50" width="80" src="{{ $actor->thumbnail }}"> -->
            </td>
            <!-- <td class="text-left columnstyles"><a href="{{ $actor->link }}">{{ $actor->link }}</a></td> -->
            <td class="text-left columnstyles">{{ $actor->profileViews }}</td>
            <td class="text-left columnstyles">{{ $actor->articleViews }}</td>
            <td class="text-left columnstyles">{{ $actor->appearedIn }}</td>
            <!-- <td class="text-left columnstyles">
              <form method="post" action="/actor/{{ $actor->id }}/togglestatus" style="display: block;">
                @csrf
                <input type="hidden" name="actorId" value="{{ $actor->id }}">
                @if($actor->is_active==1)
                <input type="hidden" name="toggler" value="{{ $actor->is_active }}">
                <button type="submit" style="border:none;border-radius:3px;outline:none;background: transparent;background-color:#a4e0ae;color: black;padding:10px;padding-top: 3px;padding-bottom: 3px;">Block</button>

                @elseif($actor->is_active==0)
                <input type="hidden" name="toggler" value="{{ $actor->is_active }}">
                <button type="submit" style="border:none;border-radius:3px;outline:none;background: transparent;background-color:#a4e0ae;color: black;padding:10px;padding-top: 3px;padding-bottom: 3px;">Unblock</button>
                @endif
                </form>
                <button type="submit" style="margin-top:1px;display:block;border:none;border-radius:3px;outline:none;background: transparent;background-color:#a4e0ae;color: black;padding:10px;padding-top: 3px;padding-bottom: 3px;" onclick="toggleDisplay2({!!$actor->id!!},'{!!$actor->name!!}','{!!$actor->link!!}','{!!$actor->infoDomain!!}')">Edit</button>
                <form action="/actor/{{$actor->id}}/delete" method="post">
                  @csrf
                <button type="submit" style="margin-top:1px;border:none;border-radius:3px;outline:none;background: transparent;background-color:#a4e0ae;color: black;padding:10px;padding-top: 3px;padding-bottom: 3px;">Delete</button>
                </form>
            </td> -->
            <!-- <td class="text-left columnstyles">{{ $actor->published_on }}</td> -->
            <!-- <td class="text-left columnstyles">{{ $actor->created_at }}</td>
            <td class="text-left columnstyles">{{ $actor->updated_at }}</td> -->
          </tr> 
          @endforeach
         </tbody>
      </table>
    </div>
  </div>
</div>
<!-- The Table End -->




<!-- The Popup Window -->
<div id="popup" style="position: absolute;display: none;text-align: center;top: 15%;left: 25%;z-index: 99999;">
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