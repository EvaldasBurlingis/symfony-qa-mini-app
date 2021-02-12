const voteDiv = document.querySelector('.js-vote-arrows');
const voteResult = document.querySelector('.js-vote-total');

voteDiv.addEventListener('click', (e) => {
    e.preventDefault();

    const direction = e.target.getAttribute('data-direction');
    
    fetch(`/comments/10/vote/${direction}`, {
        method: 'POST'
    })
    .then(res => res.json())
    .then(data => voteResult.textContent = data.votes)
    .catch(err => console.error(err));
});
