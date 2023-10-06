@extends('layouts.app')

@section('content')

    <body>
   <div class="container" >

       <div id="message" >
       </div>
       <div class="alert alert-success" role="alert" id="successMsg" style="display: none" >
           Thank you for getting in touch!
       </div>
       <form id="regForm">
           <div class="form-control">
               <label for="name">Ім'я:</label>
               <input type="text" name="name" id="name" class="form-control">
           </div>
           <div class="form-control">
               <label for="surname">Прізвище</label>
               <input type="text" name="surname" id="surname" class="form-control">
           </div>
           <div class="form-control">
               <label for="email">Email:</label>
               <input type="text" name="email" id="email" class="form-control">
           </div>
           <div class="form-control">
               <label for="password">Пароль:</label>
               <input type="text" name="password" id="password" class="form-control">
           </div>
           <div class="form-control">
               <label for="password">Підтвердіть пароль:</label>
               <input type="text" name="confirm_password" id="confirm_password" class="form-control">
           </div>
           <button type="submit"  class="btn btn-primary">Зареєструватися</button>
       </form>

   </div>

    </body>

@endsection
