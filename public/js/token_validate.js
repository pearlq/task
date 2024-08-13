function getToken() {
    return localStorage.getItem('token');
}

document.addEventListener("load", function () {
    const token = getToken()

    async function fetchData() {
        if (!token) {
            window.location.href = '/login';
            return;
        }

        try {
            const response = await fetch('/token/validate', {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + token
                }
            });
            if (!response.ok) {
                localStorage.removeItem('token')
                window.location.href = '/login'
            }
        } catch (error) {
            console.error('Error fetching dashboard:', error);
        }
    }
    fetchData();
});