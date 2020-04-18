<!DOCTYPE html>
<html lang="ja">
  <head>
  <meta charset="utf-8">
  <!-- BootstrapのCSS読み込み -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- jQuery読み込み -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- BootstrapのJS読み込み -->
  <script src="js/bootstrap.min.js"></script>
  <!-- Vue.jsのJS読み込み -->    
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>
  <!--datePicker関連-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.min.css" />
  <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js" integrity="sha384-0pzryjIRos8mFBWMzSSZApWtPl/5++eIfzYmTgBBmXYdhvxPc+XcFEk+zJwDgWbP" crossorigin="anonymous"></script>
  <!--自作CSS-->  
  <link href="css/custom.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width">
  <title>家計簿</title>
</head>

<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="index.php"><img src="images/common/home_icon.png" class="nav-homeicon bg-white"><a>
    <span class="navbar-text text-warning">新規記入<span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navmenu"
     aria-controls="navmenu" area-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
     </button>
      <div class="collapse navbar-collapse" id="navmenu">
        <div class="navbar-nav">
          <a class="nav-item nav-link" href="./read_book">家計簿を見る</a>
          <a class="nav-item nav-link" href="./read_book_aggregate?table_name=category_balance">年表を見る</a>
        </div>
        <!--.navbar-nav-->
      </div>
      <!--#navmenu-->
  </nav>

  <div class="row　justify-content-around mtpx-100">
    <div class="container col-md-10 offset-md-1 col-lg-4 card" id="input_form">
      <form action="input_book" method="post" id="form" >
      @csrf
      {{-- 日付 --}}
      　<div class="row">
          <div class="container col-md-10 offset-md-1">
            <label for="category_balance" class="txt-itemname" >日付</label>
            <input type="text" name="pay_day" class="form-control datetimepicker-input"
              id="datetimepicker" data-toggle="datetimepicker" data-target="#datetimepicker"
            />
          </div>
        </div>
        {{-- 収支 --}}
        <div class="row" >
          <div class="container col-md-10 offset-md-1">
            <label for="category_balance"　class="txt-itemname">収支</label>
            <select name="category_balance" class="form-control" 
            id="category_balance" v-model="category_balance">
              <option v-for="item in json_balance" v-bind:value="item.code">@{{item.name}}</option>
          </select>
          </div>
        </div>
        {{-- 大分類 --}}
        <div class="row">
          <div class="container col-md-10 offset-md-1">
            <label for="category_large"　class="txt-itemname">大分類</label>
            <select name="category_large" class="form-control" id="category_large" v-model="category_large">
              <option v-for="item in json_large" v-bind:value="item.code">@{{item.name}}</option>
          </select>
          </div>
        </div>
        {{-- 中分類 --}}
        <div class="row">
          <div class="container col-md-10 offset-md-1">
            <label for="category_middle"　class="txt-itemname">中分類</label>
            <select name="category_middle"  class="form-control" id="category_middle" v-model="category_middle">
              <option v-for="item in json_middle" v-bind:value="item.code">@{{item.name}}</option>
          </select>
          </div>
        </div>
        {{-- 小分類 --}}
        <div class="row">
          <div class="container col-md-10 offset-md-1">
            <label for="category_small"　class="txt-itemname">小分類</label>
            <select name="category_small" class="form-control" id="category_small" v-model="category_small">
            <option v-for="item in json_small" v-bind:value="item.code">@{{item.name}}</option>
          </select>
          </div>
        </div>
        {{-- メモ --}}
        <div class="row">
          <div class="container col-md-10 offset-md-1">
            <label for="memo"　class="txt-itemname">メモ</label>
            <input type="text"  name="memo" class="form-control" id="memo" v-model="memo">
          </select>
          </div>
        </div>
        {{-- 金額 --}}
        <div class="row">
          <div class="container col-md-10 offset-md-1">
            <label for="payment"　class="txt-itemname">金額</label>
            <input type="text" id="payment"  name="payment" class="form-control" 
            v-model="payment">
            @if($errors->has('payment'))
            <p>整数を入力してください。</p>
            @endif
          </div>
        </div><!--row-->
        <div class="row mt-5">
          <div class="container col-6 col-md-offset-1 mb-5">
            <input type="submit" class="btn-lg btn-block btn-primary" value="書き込む">
          </div>
        </div><!--row-->
      </form>
    </div>
  </div><!--row-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/ja.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/js/tempusdominus-bootstrap-4.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('js/201_input_book.js')}}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker').datetimepicker({
            locale: 'ja',
            dayViewHeaderFormat: 'YYYY年 M月',
            format: 'YYYY-MM-DD',
            viewMode:'days',
            defaultDate:new Date()
        });
    });
</script>
</body>
</html>