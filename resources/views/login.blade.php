@extends('layout.master2')


<div class="container" id="mainDiv">

    <form method="post" action="/auth">
        <div class="row">
            <div class="col-sm-3 blog-main">
            </div>
            <div class="col-sm-6 blog-main">
                <div class="container" style="text-align:center;">
                    <h1 class="display-3">CQV E-Learning</h1>
                    <p class="lead">Learn the fun way.</p>
                </div>
                <br> 
                <br>
                @if (session('status'))
                    <div class="alert alert-danger" style="text-align:center;">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="form-group row">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="email" name="uname" placeholder= "Your email" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input name="pword" class="form-control" id="inputPassword" placeholder="Password" type="password">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary" name = "submit">Sign in</button>
                    </div>
                </div>

                sample account<br>
                uname: c@c.com<br>
                pword: bry

              

            </div>

            </div>
        </div>
    </form>


      <hr>
                <br>
                <br>
                <br>
                <br>
                
                <form method="POST" action="/upload/image" class="form-horizontal" role="form"  enctype="multipart/form-data">
                {!! csrf_field() !!}
                    <div class="form-group">
                        <label class="col-md-3 control-label">Attach file:</label>
                        <div class="col-md-8">
                            <input  type="file" id="resume" name="resume_link" placeholder="Resume" required class=""/>
                            <span class="required" id='spnFileError'></span>
                        </div>
                    </div>                
                </div>
                  <div class="modal-footer">
                    <div class="col-xs-5">
                      <p style="margin:0;text-align:left;color: green;display:none;" id="successMsg">Submitted Successfully!</p>
                    </div>
                    <button type="submit" id="btnUpload" class="custm-btn btn-primary">Submit</button>
                    <button type="button" class="custm-btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </form>
</div>

