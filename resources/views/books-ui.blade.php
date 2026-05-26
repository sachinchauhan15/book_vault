<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books Management API</title>
    <style>
        :root {
            --ink: #18202f;
            --muted: #697386;
            --line: #d9dfeb;
            --panel: #ffffff;
            --bg: #eef2f7;
            --brand: #176b87;
            --accent: #b85c38;
            --danger: #b42318;
            --ok: #16784f;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            color: var(--ink);
            background: var(--bg);
        }

        button,
        input {
            font: inherit;
        }

        button {
            border: 0;
            cursor: pointer;
            background: var(--brand);
            color: #fff;
            padding: 10px 14px;
            border-radius: 6px;
            font-weight: 700;
        }

        button.secondary {
            background: #4b5565;
        }

        button.danger {
            background: var(--danger);
        }

        button.ghost {
            background: transparent;
            color: var(--brand);
            border: 1px solid var(--line);
        }

        input {
            width: 100%;
            border: 1px solid var(--line);
            border-radius: 6px;
            padding: 10px 12px;
            color: var(--ink);
            background: #fff;
        }

        label {
            display: grid;
            gap: 6px;
            color: var(--muted);
            font-size: 13px;
            font-weight: 700;
        }

        .shell {
            max-width: 1180px;
            margin: 0 auto;
            padding: 24px;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 18px 0 24px;
        }

        .brand h1 {
            margin: 0;
            font-size: 28px;
            letter-spacing: 0;
        }

        .brand p {
            margin: 6px 0 0;
            color: var(--muted);
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 999px;
            background: #e7f6ef;
            color: var(--ok);
            font-weight: 700;
            font-size: 13px;
        }

        .grid {
            display: grid;
            grid-template-columns: 360px 1fr;
            gap: 20px;
            align-items: start;
        }

        .panel {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 8px;
            padding: 18px;
            box-shadow: 0 14px 40px rgba(24, 32, 47, 0.08);
        }

        .panel h2 {
            margin: 0 0 16px;
            font-size: 18px;
        }

        .stack {
            display: grid;
            gap: 12px;
        }

        .row {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .row > * {
            flex: 1;
        }

        .tabs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-bottom: 14px;
        }

        .tabs button {
            background: #e9edf5;
            color: var(--ink);
        }

        .tabs button.active {
            background: var(--brand);
            color: #fff;
        }

        .notice {
            display: none;
            margin-bottom: 14px;
            padding: 10px 12px;
            border-radius: 6px;
            font-weight: 700;
            font-size: 13px;
        }

        .notice.show {
            display: block;
        }

        .notice.ok {
            color: var(--ok);
            background: #e7f6ef;
        }

        .notice.error {
            color: var(--danger);
            background: #fde8e8;
        }

        .toolbar {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 10px;
            margin-bottom: 14px;
        }

        .books {
            display: grid;
            gap: 10px;
        }

        .book {
            display: grid;
            grid-template-columns: 72px 1fr auto;
            gap: 14px;
            align-items: center;
            border: 1px solid var(--line);
            border-radius: 8px;
            padding: 12px;
            background: #fbfcff;
        }

        .cover {
            width: 72px;
            height: 96px;
            border-radius: 6px;
            background: #dfe6ef;
            display: grid;
            place-items: center;
            color: var(--brand);
            font-weight: 800;
            overflow: hidden;
        }

        .cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .book h3 {
            margin: 0 0 5px;
            font-size: 17px;
        }

        .book p {
            margin: 0;
            color: var(--muted);
            font-size: 14px;
        }

        .price {
            margin-top: 8px;
            color: var(--accent);
            font-weight: 800;
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        .empty {
            padding: 28px;
            text-align: center;
            color: var(--muted);
            border: 1px dashed var(--line);
            border-radius: 8px;
            background: #fbfcff;
        }

        .profile {
            color: var(--muted);
            font-size: 14px;
            margin-bottom: 12px;
        }

        .hidden {
            display: none !important;
        }

        @media (max-width: 860px) {
            .shell {
                padding: 16px;
            }

            .grid,
            .toolbar,
            .book {
                grid-template-columns: 1fr;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .actions {
                width: 100%;
            }
        }
    </style>
</head>
<body>
<main class="shell">
    <header class="topbar">
        <div class="brand">
            <h1>Books Management</h1>
            <p>Laravel JWT CRUD dashboard</p>
        </div>
        <div class="status">API Online</div>
    </header>

    <section class="grid">
        <aside class="panel">
            <div id="message" class="notice"></div>

            <div id="authPanel">
                <div class="tabs">
                    <button id="loginTab" class="active" type="button">Login</button>
                    <button id="registerTab" type="button">Register</button>
                </div>

                <form id="loginForm" class="stack">
                    <label>Email
                        <input name="email" type="email" value="demo@example.com" required>
                    </label>
                    <label>Password
                        <input name="password" type="password" value="Password123" required>
                    </label>
                    <button type="submit">Login</button>
                </form>

                <form id="registerForm" class="stack hidden">
                    <label>Name
                        <input name="name" type="text" required>
                    </label>
                    <label>Email
                        <input name="email" type="email" required>
                    </label>
                    <label>Password
                        <input name="password" type="password" required>
                    </label>
                    <label>Confirm Password
                        <input name="password_confirmation" type="password" required>
                    </label>
                    <button type="submit">Register</button>
                </form>
            </div>

            <div id="bookFormPanel" class="hidden">
                <div class="profile" id="profileText"></div>
                <h2 id="formTitle">Add Book</h2>
                <form id="bookForm" class="stack">
                    <input type="hidden" name="id">
                    <label>Title
                        <input name="title" type="text" required>
                    </label>
                    <label>Author
                        <input name="author" type="text" required>
                    </label>
                    <label>Price
                        <input name="price" type="number" min="0" step="0.01" required>
                    </label>
                    <label>Published Date
                        <input name="published_date" type="date">
                    </label>
                    <label>Cover Image
                        <input name="cover_image" type="file" accept="image/*">
                    </label>
                    <div class="row">
                        <button type="submit">Save Book</button>
                        <button id="resetBookForm" class="ghost" type="button">Clear</button>
                    </div>
                    <button id="logoutButton" class="secondary" type="button">Logout</button>
                </form>
            </div>
        </aside>

        <section class="panel">
            <h2>Books</h2>
            <div class="toolbar">
                <input id="searchInput" type="search" placeholder="Search by title or author">
                <button id="searchButton" type="button">Search</button>
            </div>
            <div id="books" class="books">
                <div class="empty">Login to load books.</div>
            </div>
        </section>
    </section>
</main>

<script>
    const tokenKey = 'books_api_token';
    const state = {
        token: localStorage.getItem(tokenKey) || '',
        user: null,
        page: 1,
    };

    const message = document.getElementById('message');
    const authPanel = document.getElementById('authPanel');
    const bookFormPanel = document.getElementById('bookFormPanel');
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const bookForm = document.getElementById('bookForm');
    const booksEl = document.getElementById('books');
    const profileText = document.getElementById('profileText');
    const formTitle = document.getElementById('formTitle');

    function showMessage(text, type = 'ok') {
        message.textContent = text;
        message.className = `notice show ${type}`;
        window.setTimeout(() => {
            message.className = 'notice';
        }, 3500);
    }

    async function api(path, options = {}) {
        const headers = options.headers || {};

        if (!(options.body instanceof FormData)) {
            headers.Accept = 'application/json';
            headers['Content-Type'] = 'application/json';
        } else {
            headers.Accept = 'application/json';
        }

        if (state.token) {
            headers.Authorization = `Bearer ${state.token}`;
        }

        const response = await fetch(path, {...options, headers});
        const data = await response.json().catch(() => ({}));

        if (!response.ok) {
            throw new Error(data.message || 'Request failed');
        }

        return data;
    }

    function setAuthenticated(isAuthenticated) {
        authPanel.classList.toggle('hidden', isAuthenticated);
        bookFormPanel.classList.toggle('hidden', !isAuthenticated);
    }

    function resetBookForm() {
        bookForm.reset();
        bookForm.elements.id.value = '';
        formTitle.textContent = 'Add Book';
    }

    function renderBooks(books) {
        if (!books.length) {
            booksEl.innerHTML = '<div class="empty">No books found.</div>';
            return;
        }

        booksEl.innerHTML = books.map((book) => `
            <article class="book">
                <div class="cover">
                    ${book.cover_image_url ? `<img src="${book.cover_image_url}" alt="${book.title}">` : 'BOOK'}
                </div>
                <div>
                    <h3>${escapeHtml(book.title)}</h3>
                    <p>${escapeHtml(book.author)}</p>
                    <p>${book.published_date || 'No published date'}</p>
                    <div class="price">₹${Number(book.price).toFixed(2)}</div>
                </div>
                <div class="actions">
                    <button class="secondary" type="button" onclick='editBook(${JSON.stringify(book)})'>Edit</button>
                    <button class="danger" type="button" onclick="deleteBook(${book.id})">Delete</button>
                </div>
            </article>
        `).join('');
    }

    function escapeHtml(value) {
        return String(value)
            .replaceAll('&', '&amp;')
            .replaceAll('<', '&lt;')
            .replaceAll('>', '&gt;')
            .replaceAll('"', '&quot;')
            .replaceAll("'", '&#039;');
    }

    async function loadProfile() {
        const response = await api('/api/auth/profile');
        state.user = response.data;
        profileText.textContent = `Logged in as ${state.user.name} (${state.user.email})`;
    }

    async function loadBooks() {
        const search = document.getElementById('searchInput').value;
        const response = await api(`/api/books?search=${encodeURIComponent(search)}&page=${state.page}`);
        renderBooks(response.data || []);
    }

    window.editBook = function (book) {
        formTitle.textContent = 'Edit Book';
        bookForm.elements.id.value = book.id;
        bookForm.elements.title.value = book.title;
        bookForm.elements.author.value = book.author;
        bookForm.elements.price.value = book.price;
        bookForm.elements.published_date.value = book.published_date || '';
        bookForm.elements.cover_image.value = '';
    };

    window.deleteBook = async function (id) {
        if (!confirm('Delete this book?')) {
            return;
        }

        await api(`/api/books/${id}`, {method: 'DELETE'});
        showMessage('Book deleted successfully');
        await loadBooks();
    };

    document.getElementById('loginTab').addEventListener('click', () => {
        loginForm.classList.remove('hidden');
        registerForm.classList.add('hidden');
        document.getElementById('loginTab').classList.add('active');
        document.getElementById('registerTab').classList.remove('active');
    });

    document.getElementById('registerTab').addEventListener('click', () => {
        loginForm.classList.add('hidden');
        registerForm.classList.remove('hidden');
        document.getElementById('loginTab').classList.remove('active');
        document.getElementById('registerTab').classList.add('active');
    });

    loginForm.addEventListener('submit', async (event) => {
        event.preventDefault();

        try {
            const body = Object.fromEntries(new FormData(loginForm));
            const response = await api('/api/auth/login', {
                method: 'POST',
                body: JSON.stringify(body),
            });

            state.token = response.data.token;
            localStorage.setItem(tokenKey, state.token);
            setAuthenticated(true);
            await loadProfile();
            await loadBooks();
            showMessage('Login successful');
        } catch (error) {
            showMessage(error.message, 'error');
        }
    });

    registerForm.addEventListener('submit', async (event) => {
        event.preventDefault();

        try {
            const body = Object.fromEntries(new FormData(registerForm));
            await api('/api/auth/register', {
                method: 'POST',
                body: JSON.stringify(body),
            });

            showMessage('Registration successful. You can login now.');
            registerForm.reset();
            document.getElementById('loginTab').click();
        } catch (error) {
            showMessage(error.message, 'error');
        }
    });

    bookForm.addEventListener('submit', async (event) => {
        event.preventDefault();

        try {
            const id = bookForm.elements.id.value;

            if (id) {
                await api(`/api/books/${id}`, {
                    method: 'PUT',
                    body: JSON.stringify({
                        title: bookForm.elements.title.value,
                        author: bookForm.elements.author.value,
                        price: bookForm.elements.price.value,
                        published_date: bookForm.elements.published_date.value || null,
                    }),
                });
            } else {
                const formData = new FormData(bookForm);
                formData.delete('id');
                await api('/api/books', {
                    method: 'POST',
                    body: formData,
                });
            }

            resetBookForm();
            await loadBooks();
            showMessage(id ? 'Book updated successfully' : 'Book created successfully');
        } catch (error) {
            showMessage(error.message, 'error');
        }
    });

    document.getElementById('resetBookForm').addEventListener('click', resetBookForm);

    document.getElementById('logoutButton').addEventListener('click', () => {
        localStorage.removeItem(tokenKey);
        state.token = '';
        state.user = null;
        setAuthenticated(false);
        booksEl.innerHTML = '<div class="empty">Login to load books.</div>';
        showMessage('Logged out');
    });

    document.getElementById('searchButton').addEventListener('click', loadBooks);
    document.getElementById('searchInput').addEventListener('keydown', (event) => {
        if (event.key === 'Enter' && state.token) {
            loadBooks();
        }
    });

    if (state.token) {
        setAuthenticated(true);
        loadProfile()
            .then(loadBooks)
            .catch(() => {
                localStorage.removeItem(tokenKey);
                state.token = '';
                setAuthenticated(false);
            });
    } else {
        setAuthenticated(false);
    }
</script>
</body>
</html>
