var vid = document.getElementById('vid');
var vidDesc = document.getElementById('vidDesc');
var title = document.getElementById('title');
            
// Handle all 6 YouTube videos
// Query setting ********
var titleName = title.innerHTML;
var searchQuery = '';

switch (titleName) {
    case 'Tai Chi':
        searchQuery = 'tai+chi';
        break;
    case 'Study Stretch':
        searchQuery = 'study+stretching';
        break;
    case 'Weekend Recovery':
        searchQuery = 'bcit+yoga';
        break;
    case 'CTC':
        searchQuery = 'CTC+training';
        break;
    case 'Mui Tai Kickboxing':
        searchQuery = 'mui+thai';
        break;
    case 'Ladies Who Lift':
        searchQuery = 'weight+lifting';
        break;
}

var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        // Typical action to be performed when the document is ready:
        var result = JSON.parse(this.response);
        
        // Change the video description
        // result['items'][0]['snippet']['description'];
        var description = result['items'][0]['snippet']['description'];
        vidDesc.innerHTML = description;
        
        // Change the video source
        var tag = result['items'][0]['id']['videoId'];
        vid.src = 'https://www.youtube.com/embed/' + tag;
    }
};

// Setup request
var reqUrl = 'https://www.googleapis.com/youtube/v3/search?part=snippet&maxResults=1&q=' + searchQuery + '&key=AIzaSyBmEgHy0Fs50bRDv2N-4LJYSy0-MkT-K50';

xhttp.open("GET", reqUrl, true);
xhttp.send();