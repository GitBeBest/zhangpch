/**
 * Created by zpc on 17-2-7.
 */
// $(document).ready(function(){
//     $(".admin-left li").click(function(){
//         $(this).addClass('current');
//         var currentIndex = $(this).index();
//         $(".admin-left ul li").each(function(index){
//             if(index != currentIndex && $(this).hasClass('current')) {
//                 $(this).removeClass('current');
//             }
//         });
//         if(currentIndex == 0){
//             $.ajax({
//                 url: '/admin/article/publish_lists',
//                 type: 'POST',
//                 dataType: 'JSON',
//                 data: {},
//                 success: function(data){
//                     $data = data;
//                 },
//                 error: function(data){
//
//                 }
//             });
//         }
//     });
// });