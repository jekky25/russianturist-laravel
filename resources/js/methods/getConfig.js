export default async function getConfig() {
	let obj = new Object();
	await axios.get('/api/get/config/')
	.then(res => {
		obj.config = res.data;
	})
	.catch(res => {
		obj.errors = res.data;
	});
	return obj;
}