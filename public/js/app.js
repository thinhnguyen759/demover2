async function likePost(postId) {

    //step 1: send request to sever
    const response = await fetch('/reactions', {
        method: "POST", // *GET, POST, PUT, DELETE, etc.
        mode: "cors", // no-cors, *cors, same-origin
        cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
        credentials: "same-origin", // include, *same-origin, omit
        headers: {
            "Content-Type": "application/json",
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            // 'Content-Type': 'application/x-www-form-urlencoded',
        },
        redirect: "follow", // manual, *follow, error
        referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
        body: JSON.stringify({
            'post_id': postId
        }), // body data type must match "Content-Type" header
    });
    result = await response.json();
    if (result.action == 'liked') {
        $("#like-bnt-" + postId).addClass('reaction-liked')

    } else {
        $("#like-bnt-" + postId).removeClass('reaction-liked')
    }
    $("#like-count-" + postId).text(result.count);
    console.log(response.json()); // parses JSON response into native JavaScript objects
    return null;

//step 2: receive data from sever
//step 3: update html/ show alert
}


// add comment
$('#add-comment').click(function (ev) {
    ev.preventDefault();
    let content = $('#comment-content').val();
    let postId = $('#post_id').val();

    addComment(postId, content);
});

async function addComment(postId, content) {
    //step 1: send request to server
    const response = await fetch('/comments', {
        method: "POST",
        mode: "cors",
        cache: "no-cache",
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/json",
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        redirect: "follow",
        referrerPolicy: "no-referrer",
        body: JSON.stringify({
            'post_id': postId,
            'content': content
        }),
    });

    result = await response.json();

    console.log(result);
}






