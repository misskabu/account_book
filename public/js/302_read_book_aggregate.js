// $(function(){
//   var oldYear = $("#oldYear").val();
//   $('#year').val(oldYear);
//   $('#year').change(function(){
//     console.log($(this).val());
//     var currentURL = location.href;
//     console.log(currentURL);
//     var year = $(this).val();
//     URL = currentURL + '&year=' + year;
//     console.log(URL);
//     location.href = URL;
//   })
// })

// import myComponent from './select-year.vue';
new Vue({
  el:'#app',
  components:{myComponent},
  template:'<select-year></select-year>'
})

