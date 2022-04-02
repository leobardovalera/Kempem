export default require("axios").create({
	headers: {
		Accept: "application/json",
		"Content-Type": "application/json",
		"X-Requested-With": "XMLHttpRequest",
		"X-CSRF-TOKEN": csrfToken
	}
});
