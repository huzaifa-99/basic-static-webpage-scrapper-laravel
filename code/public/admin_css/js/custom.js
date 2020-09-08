



function searchTable(){
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("articlesTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }

}







function toggleDisplay(){
		var id = document.getElementById('popup');
    console.log(id);
		if(id.style.display=='none'){
			id.style.display='block';
			document.getElementById('page-mask').style.display='block';
			return true;
		}
		document.getElementById('page-mask').style.display='none';
		id.style.display='none';
		return true;
}

function toggleDisplay2(idofnewspaper,name,link,domain){
    var id = document.getElementById('popup2');
    
    if(id.style.display=='none'){
      id.style.display='block';
      document.getElementById('page-mask').style.display='block';
      console.log(idofnewspaper);

      document.getElementById('text-field-hero-input4').value=name;
      document.getElementById('text-field-hero-input5').value=link;
      document.getElementById('newspaper-hidden-id').value=idofnewspaper;

     // set the political attribute here


      return true;
    }
    document.getElementById('page-mask').style.display='none';
    id.style.display='none';
    return true;
}

function confirm() {
  confirm("Are You Sure You Want To Permanently Delete This Newspaper Source");
}

$(document).ready(function(){
    $(document).mouseup(function(e) 
    {
        var container = $("#popup");
        var container1 = $("#popup2");

        var choiceBox = $("#choiceBox");
        var choiceBox1 = $("#choiceBox1");
        var choiceBox2 = $("#choiceBox2");
        var choiceBox3 = $("#choiceBox3");
        var choiceBox4 = $("#choiceBox4");

        var choiceBox5 = $("#choiceBox5");
        var choiceBox6 = $("#choiceBox6");
        var choiceBox7 = $("#choiceBox7");
        var choiceBox8 = $("#choiceBox8");
        var choiceBox9 = $("#choiceBox9");

        var choiceBox_Class = $(".choiceBox9");

        // if the target of the click isn't the container nor a descendant of the container
        if (!container.is(e.target) && !choiceBox.is(e.target) && 
        	!choiceBox1.is(e.target) && !choiceBox2.is(e.target) && 
        	!choiceBox3.is(e.target) && !choiceBox4.is(e.target) && 
        	 container.has(e.target).length === 0 &&
          !container1.is(e.target) && !choiceBox5.is(e.target) && 
          !choiceBox6.is(e.target) && !choiceBox7.is(e.target) && 
          !choiceBox8.is(e.target) && !choiceBox9.is(e.target) && 
           container1.has(e.target).length === 0) 
        {
        	document.getElementById('page-mask').style.display='none';
            container.hide();
            container1.hide();
        }

    });
});

// Input Type File Hide/Show Function Start
function hide_label_show_inputTYPEfile(){
  if(document.getElementById('text-field-hero-input3').value=="")
  {
      // console.log("skcns");
      document.getElementById('text-field-hero-input3').style.display="none";
      document.getElementById('text-field-hero-input3').classList.remove("mdc-text-field__input");
      document.getElementById('label1').style.display="block";
  }
  else
  {
      // console.log("bkscksb");
      document.getElementById('text-field-hero-input3').style.display="block";
      document.getElementById('text-field-hero-input3').classList.add("mdc-text-field__input");
      document.getElementById('label1').style.display="none";
  }
}
// Input Type File Hide/Show Function End

// Input Type File Hide/Show Function Start
function hide_label_show_inputTYPEfile2(){
  if(document.getElementById('text-field-hero-input6').value=="")
  {
      // console.log("skcns");
      document.getElementById('text-field-hero-input6').style.display="none";
      document.getElementById('text-field-hero-input6').classList.remove("mdc-text-field__input");
      document.getElementById('label1').style.display="block";
  }
  else
  {
      // console.log("bkscksb");
      document.getElementById('text-field-hero-input6').style.display="block";
      document.getElementById('text-field-hero-input6').classList.add("mdc-text-field__input");
      document.getElementById('label1').style.display="none";
  }
}
// Input Type File Hide/Show Function End


$(document).ready(function(){
// Add new Newspaper Form Ajax Start
    $("#newspaper-new").submit(function(e){
        e.preventDefault();
        // console.log('hey');
        var data = new FormData(this);
        // console.log(data);
        $.ajax({
            type: 'POST',
            url: '/newspaper-new',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if($.isEmptyObject(data.error)){
                	// refresh the page here
                  // location=location;
                  // console.log('ajax success');
                  document.getElementById('name-error-dialog').style.display='none';
                  document.getElementById('name-error').innerHTML='';

                  document.getElementById('link-error-dialog').style.display='none';
                  document.getElementById('link-error').innerHTML='';

                  document.getElementById('article-error-dialog').style.display='none';
                  document.getElementById('article-error').innerHTML='';

                  document.getElementById('linknode-error-dialog').style.display='none';
                  document.getElementById('linknode-error').innerHTML='';

                  document.getElementById('title-error-dialog').style.display='none';
                  document.getElementById('title-error').innerHTML='';

                  document.getElementById('title-error-dialog').style.display='none';
                  document.getElementById('title-error').innerHTML='';

                  document.getElementById('body-error-dialog').style.display='none';
                  document.getElementById('body-error').innerHTML='';

                  document.getElementById('publisher-error-dialog').style.display='none';
                  document.getElementById('publisher-error').innerHTML='';

                  document.getElementById('thumbnail-error-dialog').style.display='none';
                  document.getElementById('thumbnail-error').innerHTML='';

                  location=location;
                }
                else{
                  // handle the errors here

                  // if(typeof data.error.name == 'undefined')
                  if(data.error.name == null){
                    document.getElementById('name-error-dialog').style.display='none';
                    document.getElementById('name-error').innerHTML='';
                  }
                	else if(data.error.name!==null){
                    document.getElementById('name-error-dialog').style.display='block';
                    document.getElementById('name-error').innerHTML=data.error.name;
                  }

                  if(data.error.link == null){
                    document.getElementById('link-error-dialog').style.display='none';
                    document.getElementById('link-error').innerHTML='';
                  }
                  else if(data.error.link!==null){
                    document.getElementById('link-error-dialog').style.display='block';
                    document.getElementById('link-error').innerHTML=data.error.link;
                  }

                  // if(data.error.domain == null){
                  //   document.getElementById('domain-error-dialog').style.display='none';
                  //   document.getElementById('domain-error').innerHTML='';
                  // }
                  // else if(data.error.domain!==null){
                  //   document.getElementById('domain-error-dialog').style.display='block';
                  //   document.getElementById('domain-error').innerHTML=data.error.domain;
                  // }

                  // if(data.error.thumbnail == null){
                  //   document.getElementById('thumbnail-error-dialog').style.display='none';
                  //   document.getElementById('thumbnail-error').innerHTML='';
                  // }
                  // else if(data.error.thumbnail!==null){
                  //   document.getElementById('thumbnail-error-dialog').style.display='block';
                  //   document.getElementById('thumbnail-error').innerHTML=data.error.thumbnail;
                  // }

                  if(data.error.article == null){
                    document.getElementById('article-error-dialog').style.display='none';
                    document.getElementById('article-error').innerHTML='';
                  }
                  else if(data.error.article!==null){
                    document.getElementById('article-error-dialog').style.display='block';
                    document.getElementById('article-error').innerHTML=data.error.article;
                  }

                  if(data.error.linknode == null){
                    document.getElementById('linknode-error-dialog').style.display='none';
                    document.getElementById('linknode-error').innerHTML='';
                  }
                  else if(data.error.linknode!==null){
                    document.getElementById('linknode-error-dialog').style.display='block';
                    document.getElementById('linknode-error').innerHTML=data.error.linknode;
                  }

                  if(data.error.title == null){
                    document.getElementById('title-error-dialog').style.display='none';
                    document.getElementById('title-error').innerHTML='';
                  }
                  else if(data.error.title!==null){
                    document.getElementById('title-error-dialog').style.display='block';
                    document.getElementById('title-error').innerHTML=data.error.title;
                  }

                  if(data.error.body == null){
                    document.getElementById('body-error-dialog').style.display='none';
                    document.getElementById('body-error').innerHTML='';
                  }
                  else if(data.error.body!==null){
                    document.getElementById('body-error-dialog').style.display='block';
                    document.getElementById('body-error').innerHTML=data.error.body;
                  }

                  if(data.error.thumbnail == null){
                    document.getElementById('thumbnail-error-dialog').style.display='none';
                    document.getElementById('thumbnail-error').innerHTML='';
                  }
                  else if(data.error.thumbnail!==null){
                    document.getElementById('thumbnail-error-dialog').style.display='block';
                    document.getElementById('thumbnail-error').innerHTML=data.error.thumbnail;
                  }

                  if(data.error.publisher == null){
                    document.getElementById('publisher-error-dialog').style.display='none';
                    document.getElementById('publisher-error').innerHTML='';
                  }
                  else if(data.error.publisher!==null){
                    document.getElementById('publisher-error-dialog').style.display='block';
                    document.getElementById('publisher-error').innerHTML=data.error.publisher;
                  }

                  if(data.error.published_on == null){
                    document.getElementById('published_on-error-dialog').style.display='none';
                    document.getElementById('published_on-error').innerHTML='';
                  }
                  else if(data.error.published_on!==null){
                    document.getElementById('published_on-error-dialog').style.display='block';
                    document.getElementById('published_on-error').innerHTML=data.error.published_on;
                  }

                }
            },
            });
    });
    // Add new Newspaper Form Ajax End



    // Edit Newspaper Form Ajax Start
    $("#newspaper-edit").submit(function(e){
        e.preventDefault();
        // console.log('hey');
        var data = new FormData(this);
        // console.log(data);
        $.ajax({
            type: 'POST',
            url: '/newspaper-edit',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if($.isEmptyObject(data.error)){
                  // refresh the page here
                  // location=location;
                }
                else{
                  // handle the errors here

                  // if(typeof data.error.name == 'undefined')
                  if(data.error.name == null){
                    document.getElementById('edit-name-error-dialog').style.display='none';
                    document.getElementById('edit-name-error').innerHTML='';
                  }
                  else if(data.error.name!==null){
                    document.getElementById('edit-name-error-dialog').style.display='block';
                    document.getElementById('edit-name-error').innerHTML=data.error.name;
                  }

                  if(data.error.link == null){
                    document.getElementById('edit-link-error-dialog').style.display='none';
                    document.getElementById('edit-link-error').innerHTML='';
                  }
                  else if(data.error.link!==null){
                    document.getElementById('edit-link-error-dialog').style.display='block';
                    document.getElementById('edit-link-error').innerHTML=data.error.link;
                  }

                  if(data.error.domain == null){
                    document.getElementById('edit-domain-error-dialog').style.display='none';
                    document.getElementById('edit-domain-error').innerHTML='';
                  }
                  else if(data.error.domain!==null){
                    document.getElementById('edit-domain-error-dialog').style.display='block';
                    document.getElementById('edit-domain-error').innerHTML=data.error.domain;
                  }

                  if(data.error.thumbnail == null){
                    document.getElementById('edit-thumbnail-error-dialog').style.display='none';
                    document.getElementById('edit-thumbnail-error').innerHTML='';
                  }
                  else if(data.error.thumbnail!==null){
                    document.getElementById('edit-thumbnail-error-dialog').style.display='block';
                    document.getElementById('edit-thumbnail-error').innerHTML=data.error.thumbnail;
                  }

                  if(data.error.thumbnail == null){
                    document.getElementById('edit-thumbnail-error-dialog').style.display='none';
                    document.getElementById('edit-thumbnail-error').innerHTML='';
                  }
                  else if(data.error.thumbnail!==null){
                    document.getElementById('edit-thumbnail-error-dialog').style.display='block';
                    document.getElementById('edit-thumbnail-error').innerHTML=data.error.thumbnail;
                  }

                }
            },
            });
    });
    // Edit Newspaper Form Ajax End



    // Add new Newspaper Form Ajax Start
    $("#newspaper-nodes").submit(function(e){
        e.preventDefault();
        // console.log('hey');
        var data = new FormData(this);
        // console.log(data);
        $.ajax({
            type: 'POST',
            url: '/newspaper-nodes',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if($.isEmptyObject(data.error)){
                  // refresh the page here
                  // location=location;
                  document.getElementById('newswire-error-dialog').style.display='none';
                  document.getElementById('newswire-error').innerHTML='';
                  document.getElementById('title-error-dialog').style.display='none';
                  document.getElementById('title-error').innerHTML='';
                  document.getElementById('body-error-dialog').style.display='none';
                  document.getElementById('body-error').innerHTML='';
                  document.getElementById('thumbnail-error-dialog').style.display='none';
                  document.getElementById('thumbnail-error').innerHTML='';
                  document.getElementById('publisher-error-dialog').style.display='none';
                  document.getElementById('publisher-error').innerHTML='';
                }
                else{
                  // handle the errors here

                  // if(typeof data.error.name == 'undefined')
                  if(data.error.newswire == null){
                    document.getElementById('newswire-error-dialog').style.display='none';
                    document.getElementById('newswire-error').innerHTML='';
                  }
                  else if(data.error.newswire!==null){
                    document.getElementById('newswire-error-dialog').style.display='block';
                    document.getElementById('newswire-error').innerHTML=data.error.newswire;
                  }

                  if(data.error.title == null){
                    document.getElementById('title-error-dialog').style.display='none';
                    document.getElementById('title-error').innerHTML='';
                  }
                  else if(data.error.title!==null){
                    document.getElementById('title-error-dialog').style.display='block';
                    document.getElementById('title-error').innerHTML=data.error.title;
                  }

                  if(data.error.body == null){
                    document.getElementById('body-error-dialog').style.display='none';
                    document.getElementById('body-error').innerHTML='';
                  }
                  else if(data.error.body!==null){
                    document.getElementById('body-error-dialog').style.display='block';
                    document.getElementById('body-error').innerHTML=data.error.body;
                  }

                  if(data.error.thumbnail == null){
                    document.getElementById('thumbnail-error-dialog').style.display='none';
                    document.getElementById('thumbnail-error').innerHTML='';
                  }
                  else if(data.error.thumbnail!==null){
                    document.getElementById('thumbnail-error-dialog').style.display='block';
                    document.getElementById('thumbnail-error').innerHTML=data.error.thumbnail;
                  }

                  if(data.error.publisher == null){
                    document.getElementById('publisher-error-dialog').style.display='none';
                    document.getElementById('publisher-error').innerHTML='';
                  }
                  else if(data.error.publisher!==null){
                    document.getElementById('publisher-error-dialog').style.display='block';
                    document.getElementById('publisher-error').innerHTML=data.error.publisher;
                  }

                }
            },
            });
    });
    // Add new Newspaper Form Ajax End


    // Send the new article form ajax
    CKEDITOR.replace('description');
    $('#new_article').submit(function(e){

        for ( instance in CKEDITOR.instances ) {
          CKEDITOR.instances['description'].updateElement();
        }

        // { ckeditor wasnt sending input from textarea the first time only so i found a solution from https://stackoverflow.com/questions/24398225/ckeditor-doesnt-submit-data-via-ajax-on-first-submit by Sudhir Bastakoti answered Jun 25 '14 at 0:51 } reviewed on 20/3/20 project8 led me here. 
        // console.log(document.getElementById('body').value);
        // for ( instance in CKEDITOR.instances ) {
        // CKEDITOR.instances[instance].updateElement();
        // }
        // ckeditor wasnt sending input close

        e.preventDefault();
        var title = document.getElementById('title').value;
        var body = document.getElementById('description').value;
        var data = new FormData(this);
        console.log(data.title);
          $.ajax({
              type: 'POST',
              url: '/articles/new',
              data: {title: title,body: body},
              cache:false,
              contentType: false,
              processData: false,
              success: function (data) {
                if(data){
                  console.log(data);
                }
                else{
                  alert(data);
                }
              }
          });
      });
    // Send the new article form ajax


      



});

function picturePerfect(){
  console.log('function');
  console.log(this.innerHTML);
}



// CKEDITOR.replace( 'editor', {
//   on: { 
//          loaded: function() {ajaxRequest();}
//       }
//   });




// ClassicEditor
//     .create( document.querySelector( '#bodytext' ), {
//         placeholder: 'Type the content here!'
//     } )
//     .then( editor => {
//         console.log( editor );
//     } )
//     .catch( error => {
//         console.error( error );
//     } );

