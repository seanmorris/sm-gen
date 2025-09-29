function Image (el)
	local base_url = os.getenv("BASE_URL")
	if base_url and not el.src:match("^https?://") then
		if not base_url:match("/$") and not el.src:match("^/") then
			el.src = base_url .. "/" .. el.src
		else
			el.src = base_url .. el.src
		end
	end
	return el
end
