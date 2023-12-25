import './bootstrap';

async function fetchRepositories() {
    try {
        const response = await fetch('/repositories');
        const repositories = await response.json();

        const repositoriesList = document.getElementById('repositories-list');
        repositoriesList.innerHTML = '<h2>Top Repositories</h2>';
        repositories.forEach((repo) => {
            repositoriesList.innerHTML += `<p>${repo.name} - Last updated: ${repo.updated_at}</p>`;
        });
    } catch (error) {
        console.error(error);
    }
}

fetchRepositories();
setInterval(fetchRepositories, 600000);
