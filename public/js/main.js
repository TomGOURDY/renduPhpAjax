$(document).ready(function () {
    
//---- Execute Ajax request after a delay after last user input ----
let typingTimerFriendSearch, typingTimerFriendListSearch;
let doneTypingInterval = 800;

$('#friend-list-search').on('input', function(){
    clearTimeout(typingTimerFriendListSearch);
    if ($('#friend-list-search').val()) {
        typingTimerFriendListSearch = setTimeout(friendListSearchRequest, doneTypingInterval);
    }
});
$('#friend-search').on('input', function(){
    clearTimeout(typingTimerFriendSearch);
    if ($('#friend-search').val()) {
        typingTimerFriendSearch = setTimeout(friendSearchRequest, doneTypingInterval);
    }
});
// setTimeout(friendListSearchRequest, 1000);

//Show all friends on page loading
$.ajax({
    url: './include/friendsResult.php?search=',
    method: 'get',
    // async: false,
    // data: {},
    success: function(response) {
        $('#friends-list').html(response);
    }
})

// function friendListSearchRequest () {
//     $("#friends-list").html('<p>' + $('#friend-list-search').val() + '</p>');
//     // $("#friends-list").html('<p>hello</p>');
// }

// function friendListSearchRequest () {
//     $.ajax({
//         url: './include/friendsResult.php',
//         method: 'post',
//         data: {
//             search: $('#friend-list-search').val()
//         },
//         success: function(response) {
//             $('friends-list').html(response);
//         }
//     })
// }

// function friendSearchRequest() {
    
// }
});