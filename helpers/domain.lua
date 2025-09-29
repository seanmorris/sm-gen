function Image (el)
	local base_url = os.getenv("BASE_URL")
	if base_url and not el.src:match("^https?://") then
		el.src = base_url .. el.src
	end
	return el
end
