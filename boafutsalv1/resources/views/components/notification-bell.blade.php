@auth
<div id="notifBell" class="fixed top-4 right-20 lg:right-6 z-[70]">
    <button id="notifBellBtn" type="button" title="Notifikasi"
        class="relative w-11 h-11 bg-black/60 backdrop-blur-xl border border-white/10 rounded-xl flex items-center justify-center text-gray-300 hover:text-green-400 hover:border-green-500/40 transition-all shadow-lg">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
        </svg>
        <span id="notifBadge" class="hidden absolute -top-1.5 -right-1.5 min-w-[20px] h-5 px-1 bg-red-500 text-white text-[10px] font-extrabold rounded-full flex items-center justify-center border-2 border-[#050505]">0</span>
    </button>

    <div id="notifDropdown" class="hidden absolute right-0 mt-3 w-80 max-w-[calc(100vw-2rem)] bg-[#0a0a0a] border border-white/10 rounded-2xl shadow-[0_20px_60px_rgba(0,0,0,0.8)] overflow-hidden">
        <div class="flex items-center justify-between px-4 py-3 border-b border-white/10 bg-white/5">
            <span class="text-sm font-extrabold text-white">Notifikasi</span>
            <button id="notifReadAll" type="button" class="text-[11px] font-bold text-green-400 hover:text-green-300 transition-colors">
                Tandai semua dibaca
            </button>
        </div>
        <div id="notifList" class="max-h-96 overflow-y-auto divide-y divide-white/5"></div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = '{{ csrf_token() }}';
    const bell = document.getElementById('notifBell');
    const btn = document.getElementById('notifBellBtn');
    const badge = document.getElementById('notifBadge');
    const dropdown = document.getElementById('notifDropdown');
    const list = document.getElementById('notifList');
    const readAllBtn = document.getElementById('notifReadAll');

    const typeStyles = {
        promo:   { badge: 'bg-green-500/20 text-green-400', label: 'Promo' },
        info:    { badge: 'bg-blue-500/20 text-blue-400', label: 'Info' },
        warning: { badge: 'bg-red-500/20 text-red-400', label: 'Peringatan' },
    };

    function escapeHtml(str) {
        return String(str ?? '').replace(/[&<>"']/g, function (s) {
            return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' }[s];
        });
    }

    function formatTime(value) {
        try {
            return new Date(value).toLocaleString('id-ID', {
                day: '2-digit', month: 'short', year: 'numeric',
                hour: '2-digit', minute: '2-digit'
            });
        } catch (e) {
            return '';
        }
    }

    async function refreshUnread() {
        try {
            const res = await fetch('/api/notifications/unread-count', { headers: { 'Accept': 'application/json' } });
            if (!res.ok) return;
            const data = await res.json();
            if (data.count > 0) {
                badge.textContent = data.count > 9 ? '9+' : data.count;
                badge.classList.remove('hidden');
            } else {
                badge.classList.add('hidden');
            }
        } catch (e) { /* ignore */ }
    }

    function render(items) {
        if (!items.length) {
            list.innerHTML = '<div class="px-4 py-8 text-center text-xs text-gray-500">Belum ada notifikasi</div>';
            return;
        }

        list.innerHTML = items.map(function (n) {
            const style = typeStyles[n.type] || typeStyles.info;
            return `
                <button type="button" data-id="${n.id}" class="notif-item w-full text-left px-4 py-3 hover:bg-white/5 transition-colors ${n.is_read ? 'opacity-60' : ''}">
                    <div class="flex items-start gap-3">
                        <span class="mt-0.5 px-2 py-0.5 rounded text-[10px] font-extrabold shrink-0 ${style.badge}">${style.label}</span>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-white flex items-center gap-2">
                                ${n.is_read ? '' : '<span class="w-2 h-2 rounded-full bg-green-400 shrink-0"></span>'}
                                <span class="truncate">${escapeHtml(n.title)}</span>
                            </p>
                            <p class="text-xs text-gray-400 mt-1 leading-relaxed">${escapeHtml(n.message)}</p>
                            <p class="text-[10px] text-gray-500 mt-1">${formatTime(n.created_at)}</p>
                        </div>
                    </div>
                </button>`;
        }).join('');

        list.querySelectorAll('.notif-item').forEach(function (item) {
            item.addEventListener('click', async function () {
                try {
                    await fetch('/api/notifications/' + item.dataset.id + '/read', {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                    });
                } catch (e) { /* ignore */ }
                loadNotifications();
                refreshUnread();
            });
        });
    }

    async function loadNotifications() {
        list.innerHTML = '<div class="px-4 py-8 text-center text-xs text-gray-500">Memuat...</div>';
        try {
            const res = await fetch('/api/notifications', { headers: { 'Accept': 'application/json' } });
            if (!res.ok) throw new Error('failed');
            render(await res.json());
        } catch (e) {
            list.innerHTML = '<div class="px-4 py-8 text-center text-xs text-gray-500">Gagal memuat notifikasi</div>';
        }
    }

    btn.addEventListener('click', function (e) {
        e.stopPropagation();
        dropdown.classList.toggle('hidden');
        if (!dropdown.classList.contains('hidden')) {
            loadNotifications();
        }
    });

    document.addEventListener('click', function (e) {
        if (!bell.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });

    readAllBtn.addEventListener('click', async function () {
        try {
            await fetch('/api/notifications/read-all', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
            });
        } catch (e) { /* ignore */ }
        loadNotifications();
        refreshUnread();
    });

    refreshUnread();
    setInterval(refreshUnread, 30000);
});
</script>
@endauth
