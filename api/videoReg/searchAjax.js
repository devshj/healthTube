/*----------------------- 운동 부위 선택 ajax ----------------------------*/
// 부위 상체 선택
$("#part-1").change(function(){
  $.ajax({
    url: './api/videoReg/searchVideo.php',
    type: 'GET',
    data: { part1: '상체'},
    success:function(){

    }
  })
});

// 부위 하체 선택
$("#part-2").change(function(){
  $.ajax({
    url: './api/videoReg/searchVideo.php',
    type: 'GET',
    data: { part2: '하체'},
    success:function(){

    }
  })
});

// 부위 코어 선택
$("#part-3").change(function(){
  $.ajax({
    url: './api/videoReg/searchVideo.php',
    type: 'GET',
    data: { part3: '코어'},
    success:function(){

    }
  })
});

/*----------------------- 운동 기구 선택 ajax ----------------------------*/
// 기구 있음 선택
$("#equipment-1").change(function(){
  $.ajax({
    url: './api/videoReg/searchVideo.php',
    type: 'GET',
    data: { equipment1: '있음'},
    success:function(){

    }
  })
});

// 기구 없음 선택
$("#equipment-2").change(function(){
  $.ajax({
    url: './api/videoReg/searchVideo.php',
    type: 'GET',
    data: { equipment2: '없음'},
    success:function(){

    }
  })
});
