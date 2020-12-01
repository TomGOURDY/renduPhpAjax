$(document).ready(function () {
    
    //---- Execute Ajax request after a delay after last user input ----
    let typingTimerFriendSearch, typingTimerFriendListSearch;
    let doneTypingInterval = 300;

    $('#friend-list-search').on('input', function(){
        clearTimeout(typingTimerFriendListSearch);
        // if ($('#friend-list-search').val()) {
        typingTimerFriendListSearch = setTimeout(getUserList('./include/friendsResult.php', '#friends-list', searchTerm = $('#friend-list-search').val()), doneTypingInterval);
        // }
    });
    $('#friend-search').on('input', function(){
        clearTimeout(typingTimerFriendSearch);
        if ($('#friend-search').val()) {
            typingTimerFriendSearch = setTimeout(getUserList('./include/userSearchResult.php', '#search-results', searchTerm = $('#friend-search').val()), doneTypingInterval);
        }
    });

    //Click on addFriend button
    $('#search-results').on("click", '[id^=addUser-]', function () {
        $.ajax({
            url: "../router.php",
            method: 'post',
            data: { 
                action: 'addFriend',
                friendID: $(this).val()
            },
            success: function() {
                console.log('friend added');
                //Reload the friend list and search list
                getUserList('./include/friendsResult.php', '#friends-list', searchTerm = $('#friend-list-search').val());
                console.log('friend list updated');
                getUserList('./include/userSearchResult.php', '#search-results', searchTerm = $('#friend-search').val());
                console.log('search list updated');
            }
        });
    });

    //Show all friends on page loading
    function getUserList (file, destination, searchTerm = "") {
        $.ajax({
            url: file,
            method: 'post',
            data: {search: searchTerm},
            dataType: 'html',
            success: function(response) {
                $(destination).html(response);
            }
        });
    }

    //Exec
    getUserList('./include/friendsResult.php', '#friends-list');
});