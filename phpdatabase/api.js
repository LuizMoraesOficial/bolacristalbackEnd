const API_BASE = "http://localhost/cartomante/phpdatabase";

export async function getPosts() {
  const res = await fetch(`${API_BASE}/getPosts.php`);
  return await res.json();
}

export async function addPost(post) {
  const res = await fetch(`${API_BASE}/savePost.php`, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(post)
  });
  return await res.json();
}

export async function updatePost(post) {
  const res = await fetch(`${API_BASE}/updatePost.php`, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(post)
  });
  return await res.json();
}

export async function deletePost(id) {
  const res = await fetch(`${API_BASE}/deletePost.php`, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ id })
  });
  return await res.json();
}
