const users = document.getElementById('users');

if(users){
    users.addEventListener('click', (e)=>{
        if(e.target.className ==='btn btn-danger delete-article'){
            if(confirm('Are you sure')){
                const id = e.target.getAttribute('data-id');
                fetch('/delete/'+id,{method: 'DELETE'}).then(res=>window.location.reload());
            }
        }
    })
}

if(users){
    users.addEventListener('click', (e)=>{
        if(e.target.className ==='btn btn-danger settingprofile-article'){
                const id = e.target.getAttribute('data-id');
                fetch('/settingprofile/'+id).then(res=>window.location.assign('/settingprofile/'+id));
        }
    })
}

if(users){
    users.addEventListener('click', (e)=>{
        if(e.target.className ==='myprofile'){
            const id = e.target.getAttribute('data-id');
            fetch('/profile/'+id).then(res=>window.location.assign('/profile/'+id));
        }
    })
}


if(users){
    users.addEventListener('click', (e)=>{
        if(e.target.className ==='btn btn-danger blockprofile-article'){
            if(confirm('Are you sure')){
                const id = e.target.getAttribute('data-id');
                fetch('/block/'+id,{method: 'BLOCK'}).then(res=>window.location.reload());
            }
        }
    })
}

if(users){
    users.addEventListener('click', (e)=>{
        if(e.target.className ==='btn btn-danger unlockprofile-article'){
            if(confirm('Are you sure')){
                const id = e.target.getAttribute('data-id');
                fetch('/unlock/'+id,{method: 'UNLOCK'}).then(res=>window.location.reload());
            }
        }
    })
}

if(users){
    users.addEventListener('click', (e)=>{
        if(e.target.className ==='btn btn-danger accomplishprofile-article'){
            if(confirm('Are you sure')){
                const id = e.target.getAttribute('data-id');
                fetch('/accomplish/'+id,{method: 'ACCOMPLISH'}).then(res=>window.location.reload());
            }
        }
    })
}

function show(shown, hidden) {
    document.getElementById(shown).style.display='block';
    document.getElementById(hidden).style.display='none';
    return false;
}

