$(document).ready(function () {
    
    //---- Execute Ajax request after a delay after last user input ----
    let typingTimerFriendSearch, typingTimerFriendListSearch;
    let doneTypingInterval = 300;

    $('#friend-list-search').on('input', function(){
        clearTimeout(typingTimerFriendListSearch);
        // if ($('#friend-list-search').val()) {
        typingTimerFriendListSearch = setTimeout(friendListSearchRequest, doneTypingInterval);
        // }
    });
    $('#friend-search').on('input', function(){
        clearTimeout(typingTimerFriendSearch);
        if ($('#friend-search').val()) {
            typingTimerFriendSearch = setTimeout(friendSearchRequest, doneTypingInterval);
        }
    });

    //Show all friends on page loading
    $.ajax({
        url: './include/friendsResult.php',
        method: 'post',
        async: false,
        data: {search:''},
        dataType: 'html',
        success: function(response) {
            $('#friends-list').html(response);
        }
    })

    function friendListSearchRequest () {
        $.ajax({
            url: './include/friendsResult.php',
            method: 'post',
            data: {
                search: $('#friend-list-search').val()
            },
            success: function(response) {
                $('#friends-list').html(response);
            }
        });
    }

    function friendSearchRequest() {
        $.ajax({
            url: './include/userSearchResult.php',
            method: 'post',
            data: {
                search: $('#friend-search').val()
            },
            success: function(response) {
                $('#search-results').html(response);
            }
        });
    }
});