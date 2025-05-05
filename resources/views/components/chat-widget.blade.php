<!-- In your Blade (e.g., chat-widget.blade.php) -->

<!-- Load TalkJS -->
<script>
(function(t,a,l,k,j,s){
s=a.createElement('script');s.async=1;s.src="https://cdn.talkjs.com/talk.js";a.head.appendChild(s)
;k=t.Promise;t.Talk={v:2,ready:{then:function(f){if(k)return new k(function(r,e){l.push([f,r,e])});l
.push([f])},catch:function(){return k&&new k()},c:l}};})(window,document,[]);
</script>

<!-- Floating button -->
<div id="chat-toggle-btn1" style="position: fixed; bottom: 30px; right: 30px; z-index: 999;">
    <button style="background: #0d6efd; color: white; border: none; border-radius: 50%; width: 60px; height: 60px;">
        💬
    </button>
</div>

<!-- Chat container -->
<div id="talkjs-container" style="
    position: fixed;
    bottom: 100px;
    right: 30px;
    width: 400px;
    height: 600px;
    background: white;
    display: none;
    z-index: 1000;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
">
    <i>Loading chat...</i>
</div>

<script>
    const user = {
        id: "{{ auth()->id() }}",
        name: "{{ auth()->user()->name }}",
        email: "{{ auth()->user()->email }}",
        photoUrl: "https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}",
    };

    const seller = {
    id: "{{ $services->user->id }}",
    name: "{{ $services->user->name }}",
    email: "{{ $services->user->email }}",
    photoUrl: "https://ui-avatars.com/api/?name={{ urlencode($services->user->name) }}",
};

    window.addEventListener("load", function () {
        const btn = document.getElementById('chat-toggle-btn');
        const btn1 = document.getElementById('chat-toggle-btn1');
        const chatContainer = document.getElementById('talkjs-container');

        btn.addEventListener('click', () => {
            chatContainer.style.display = chatContainer.style.display === 'none' ? 'block' : 'none';
        });

        btn1.addEventListener('click', () => {
            chatContainer.style.display = chatContainer.style.display === 'none' ? 'block' : 'none';
        });

        Talk.ready.then(function () {
            const me = new Talk.User(user);
            const other = new Talk.User(seller);

            const session = new Talk.Session({
                appId: "tYwY9u7r",
                me: me,
            });

            const conversation = session.getOrCreateConversation(Talk.oneOnOneId(me, other));
            conversation.setParticipant(me);
            conversation.setParticipant(other);

            const inbox = session.createInbox({ selected: conversation });
            inbox.mount(chatContainer);
        });
    });
</script>
