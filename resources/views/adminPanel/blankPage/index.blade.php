@extends('layouts.adminPanel.app')
@section('admintitle','BlankIndex')
@section('admin_content')

  <!-- Main Content -->
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Form Validation</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="#">Forms</a></div>
          <div class="breadcrumb-item">Form Validation</div>
        </div>
      </div>

      <div class="section-body">
        <h2 class="section-title">Form Validation</h2>
        <p class="section-lead">
          Form validation using default from Bootstrap 4
        </p>

        <div class="row">
          <div class="col-12 col-md-8 col-lg-8">
            <div class="card card-center">
              <form>
                <div class="card-header">
                  <h4>Default Validation</h4>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label>Your Name</label>
                    <input type="text" class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label>Subject</label>
                    <input type="email" class="form-control">
                  </div>
                  <div class="form-group mb-0">
                    <label>Message</label>
                    <textarea class="form-control" required=""></textarea>
                  </div>
                </div>
                <div class="card-footer text-right">
                  <button class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
         
          </div>
        </div>


        {{-- Model Form --}}
        <div class="col-12 col-md-6 col-lg-6">
            <div class="card">
              <div class="card-header">
                <h4>Modal Demo</h4>
              </div>
              <div class="card-body">
                <p class="mb-2">We've created a plugin to easily create a bootstrap modal.</p>
                <button class="btn btn-primary" id="modal-1">Launch Modal</button>
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <h4>Modal Center</h4>
              </div>
              <div class="card-body">
                <p class="mb-2">You can change the modal position to center.</p>
                <button class="btn btn-primary" id="modal-2">Launch Modal</button>
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <h4>The Others</h4>
              </div>
              <div class="card-body">
                <p class="mb-2">Check the <code>modal.js</code> code in the <code>dist/js/page</code> folder to get the source code.</p>
                <div class="buttons">
                  <button class="btn btn-primary" id="modal-3">Buttons</button>
                  <button class="btn btn-primary" id="modal-4">Footer Background</button>
                  <button class="btn btn-primary" id="modal-5">Login</button>
                  <button class="btn btn-primary" id="modal-6">Something in the Footer</button>
                </div>
              </div>
            </div>
          </div>
        
      </div>
    </section>
  </div>
    
@endsection