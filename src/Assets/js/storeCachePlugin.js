
export default function(cacheKey) {
	return createPersistedState({
		key: cacheKey,
		paths: [
			"shoppingCart"
		]
	});
}
