{{-- resources/views/chat/comment.blade.php (Enhanced Dark Style) --}}
<div class="max-w-5xl mx-auto py-6 text-gray-300">

    {{-- Alert Messages --}}
    @if(session('success'))
    <div class="bg-green-900/20 border border-green-700/50 text-green-300 px-4 py-3 rounded-lg mb-6 backdrop-blur-sm">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            {{ session('success') }}
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-900/20 border border-red-700/50 text-red-300 px-4 py-3 rounded-lg mb-6 backdrop-blur-sm">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
            </svg>
            {{ session('error') }}
        </div>
    </div>
    @endif

    <div class="mb-8">
        <div class="flex items-center justify-between">
            <h3 class="text-2xl font-bold text-white flex items-center">
                <svg class="w-7 h-7 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                Comments
                <span class="ml-3 text-lg font-semibold text-gray-400">({{ $comments->count() }})</span>
            </h3>
        </div>
        <div class="h-px bg-gradient-to-r from-transparent via-[#21262d] to-transparent mt-4"></div>
    </div>

    {{-- Form untuk comment baru --}}
    @auth
    <div class="bg-[#161b22] p-5 rounded-xl border border-[#21262d] mb-8 shadow-lg transition-colors duration-200">
        <form action="{{ route('comments.store') }}" method="POST">
            @csrf
            <input type="hidden" name="comic_id" value="{{ $comic->id }}">
            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold text-sm overflow-hidden border-2 border-[#30363d]">
                    @if(auth()->user()->profile_image)
                    <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                    @else
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    @endif
                </div>
                <div class="flex-1">
                    <textarea
                        name="comment"
                        placeholder="Share your thoughts..."
                        required
                        class="w-full px-4 py-3 bg-[#0d1117] border border-[#30363d] text-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-vertical min-h-[100px] transition-all duration-200"></textarea>
                    @error('comment')
                    <span class="text-red-400 text-sm mt-2 block flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        {{ $message }}
                    </span>
                    @enderror
                    <div class="flex justify-end mt-3">
                        <button
                            type="submit"
                            class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold px-6 py-2.5 rounded-lg transition-all duration-200 text-sm shadow-md hover:shadow-lg transform hover:-translate-y-0.5 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                                Post Comment
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @else
    <div class="bg-[#161b22] p-8 rounded-xl border border-[#21262d] mb-8 text-center shadow-lg">
        <svg class="w-16 h-16 mx-auto text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
        </svg>
        <p class="text-gray-400 text-lg">
            <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-400 font-semibold underline decoration-2 underline-offset-4 transition-colors">Login</a> to join the conversation
        </p>
    </div>
    @endauth

    {{-- List comments --}}
    @if($comments->count() > 0)
    <div id="comments-container">
        <ul class="space-y-5" id="comments-list">
            @foreach($comments as $index => $comment)
            <div class="comment-wrapper {{ $index >= 2 ? 'hidden' : '' }}" data-comment-index="{{ $index }}">
                @include('partials.chat.comment-item', ['comment' => $comment])
            </div>
            @endforeach
        </ul>

        @if($comments->count() > 2)
        <div class="mt-8 text-center">
            <button
                id="show-more-btn"
                onclick="toggleComments()"
                class="group bg-[#161b22] hover:bg-[#1c2128] border border-[#30363d] hover:border-blue-500/50 text-gray-300 hover:text-white font-semibold px-8 py-3 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg inline-flex items-center">
                <svg class="w-5 h-5 mr-2 transform group-hover:translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
                <span id="btn-text">Show {{ $comments->count() - 2 }} More Comments</span>
                <svg class="w-5 h-5 ml-2 transform group-hover:translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
        </div>
        @endif
    </div>
    @else
    <div class="bg-[#161b22] p-16 rounded-xl border border-[#21262d] text-center shadow-lg">
        <svg class="w-20 h-20 mx-auto text-gray-700 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
        </svg>
        <p class="text-gray-500 text-xl font-medium">No comments yet</p>
        <p class="text-gray-600 text-sm mt-2">Be the first to share your thoughts!</p>
    </div>
    @endif
</div>

<script>
    
        let commentsExpanded = false;
        const totalComments = {{ $comments->count() }};

        function toggleComments() {
            const hiddenComments = document.querySelectorAll('.comment-wrapper[data-comment-index]');
            const btn = document.getElementById('show-more-btn');
            const btnText = document.getElementById('btn-text');

            if (!commentsExpanded) {
                hiddenComments.forEach((comment, index) => {
                    const commentIndex = parseInt(comment.getAttribute('data-comment-index'));
                    if (commentIndex >= 2) {
                        setTimeout(() => {
                            comment.classList.remove('hidden');
                            comment.style.animation = 'slideDown 0.3s ease-out forwards';
                        }, (commentIndex - 2) * 50);
                    }
                });
                btnText.textContent = 'Show Less';
                btn.querySelector('svg:first-child').style.transform = 'rotate(180deg)';
                btn.querySelector('svg:last-child').style.transform = 'rotate(180deg)';
                commentsExpanded = true;
            } else {
                hiddenComments.forEach((comment, index) => {
                    const commentIndex = parseInt(comment.getAttribute('data-comment-index'));
                    if (commentIndex >= 2) {
                        comment.style.animation = 'slideUp 0.3s ease-out forwards';
                        setTimeout(() => {
                            comment.classList.add('hidden');
                        }, 300);
                    }
                });
                btnText.textContent = `Show ${totalComments - 2} More Comments`;
                btn.querySelector('svg:first-child').style.transform = 'rotate(0deg)';
                btn.querySelector('svg:last-child').style.transform = 'rotate(0deg)';
                commentsExpanded = false;
                
                setTimeout(() => {
                    document.getElementById('comments-container').scrollIntoView({ behavior: 'smooth', block: 'start' });
                }, 100);
            }
        }

        function toggleReplies(commentId) {
            const repliesList = document.getElementById('replies-list-' + commentId);
            const repliesIcon = document.getElementById('replies-icon-' + commentId);
            const repliesText = document.getElementById('replies-text-' + commentId);
            const toggleBtn = document.getElementById('replies-toggle-' + commentId);
            
            const isHidden = repliesList.classList.contains('hidden');
            const replyCount = repliesList.querySelectorAll(':scope > .comment-wrapper, :scope > li').length;
            
            if (isHidden) {
                repliesList.classList.remove('hidden');
                repliesList.style.animation = 'slideDown 0.3s ease-out forwards';
                repliesIcon.style.transform = 'rotate(180deg)';
                repliesText.textContent = 'Hide replies';
            } else {
                repliesList.style.animation = 'slideUp 0.3s ease-out forwards';
                setTimeout(() => {
                    repliesList.classList.add('hidden');
                }, 300);
                repliesIcon.style.transform = 'rotate(0deg)';
                repliesText.textContent = `Show ${replyCount} ${replyCount > 1 ? 'replies' : 'reply'}`;
            }
        }

        function toggleReply(commentId) {
            const form = document.getElementById('reply-form-' + commentId);
            form.classList.toggle('hidden');
            if (!form.classList.contains('hidden')) {
                form.querySelector('textarea').focus();
            }
        }

        function toggleEdit(commentId) {
            const content = document.getElementById('comment-content-' + commentId);
            const form = document.getElementById('edit-form-' + commentId);
            content.classList.toggle('hidden');
            form.classList.toggle('hidden');
            if (!form.classList.contains('hidden')) {
                form.querySelector('textarea').focus();
            }
        }

        function cancelEdit(commentId) {
            const content = document.getElementById('comment-content-' + commentId);
            const form = document.getElementById('edit-form-' + commentId);
            content.classList.remove('hidden');
            form.classList.add('hidden');
        }

        function confirmDelete(commentId) {
            if (confirm('Are you sure you want to delete this comment? This action cannot be undone.')) {
                document.getElementById('delete-form-' + commentId).submit();
            }
        }

        // Add animation styles
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideDown {
                from {
                    opacity: 0;
                    transform: translateY(-10px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            @keyframes slideUp {
                from {
                    opacity: 1;
                    transform: translateY(0);
                }
                to {
                    opacity: 0;
                    transform: translateY(-10px);
                }
            }
            #show-more-btn svg {
                transition: transform 0.3s ease;
            }
        `;
        document.head.appendChild(style);
</script>