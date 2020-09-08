@extends('layouts.admin')

@section('content')

<div class="page-wrapper mdc-toolbar-fixed-adjust">
<main class="content-wrapper">
<div class="mdc-layout-grid">
<div class="mdc-layout-grid__inner">


              <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12-desktop">
                <div class="mdc-card">
                  <h6 class="card-title">Write An Article</h6>

                  <form id="new_article" action="/articles/new" method="post" style="padding: 20px;padding-top: 50px;">
                  	@csrf
                    <input type="text" id="title" style="margin-bottom: 20px;" name="title" style="margin-top: 20px;" class="form-control" placeholder="Title">
                    <textarea id="description" name="description">
                    </textarea>
                    <input type="datetime-local" name="publishdatetime" style="margin-top: 20px;" class="form-control" value="Schecdule Time">
                    <input type="submit" name="create" style="margin-top: 20px;" class="btn btn-primary" value="Send Now">
                     <!-- onclick="CKupdate();" -->
                  </form>

                </div>
              </div>
            


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
