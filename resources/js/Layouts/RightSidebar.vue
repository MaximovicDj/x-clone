<script setup>

</script>

<template>
    <div class="h-screen overflow-y-auto px-4 sticky top-0">
        <div class="py-4">
            <!-- Search box -->
            <div class="mb-4">
                <input
                    type="text"
                    placeholder="Search"
                    class="w-full bg-gray-900 rounded-full px-4 py-2 text-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                />
            </div>

            <!-- Premium subscription card -->
            <div class="bg-gray-900 rounded-2xl p-4 mb-4">
                <h2 class="text-xl font-bold text-white mb-2">Subscribe to Premium</h2>
                <p class="text-sm text-gray-400 mb-3">Get rid of ads, see your analytics, boost your replies and unlock 20+ features.</p>
                <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full transition">
                    Subscribe
                </button>
            </div>

            <!-- Today's News -->
            <div class="bg-gray-900 rounded-2xl p-4">
                <h2 class="text-xl font-bold text-white mb-4">Today's News</h2>

                <div class="space-y-4">
                    <div class="cursor-pointer hover:bg-gray-800 transition rounded-lg p-2">
                        <p class="text-xs text-gray-500">1 hour ago · News · 12.5K posts</p>
                        <p class="text-sm text-white font-medium">Sudanese Asylum Seeker Charged After Knife Attack Sparks Belfast Riots</p>
                    </div>

                    <div class="cursor-pointer hover:bg-gray-800 transition rounded-lg p-2">
                        <p class="text-xs text-gray-500">1 hour ago · News · 1,463 posts</p>
                        <p class="text-sm text-white font-medium">France, Germany, UK Envoys Meet Russian Deputy Minister in Moscow</p>
                    </div>

                    <div class="cursor-pointer hover:bg-gray-800 transition rounded-lg p-2">
                        <p class="text-xs text-gray-500">3 days ago · Sports · 1.6M posts</p>
                        <p class="text-sm text-white font-medium">Somali Referee Barred from 2026 World Cup at U.S. Border</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
