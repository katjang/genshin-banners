<script setup lang="ts">
import { Banner, Character } from '@/models';
import { getBannerName } from '@/helpers';

const props = defineProps<{
    banners?: Banner[],
}>();

defineEmits(['click-character', 'click-weapon']);

let collapsed_banners: {[key: string]: Banner[]} = {};

if(props.banners != undefined) {
    collapsed_banners = props.banners.reduce((group: {[key: string]: Banner[]}, banner) => {
        const { end_date } = banner;
        group[end_date.toString()] = group[end_date.toString()] ?? [];
        group[end_date.toString()].push(banner);
        return group;
    }, {});
}
</script>

<template>
    <v-timeline>
        <v-timeline-item v-for="bannerPeriod in collapsed_banners" :key="bannerPeriod[0].id">
            <template v-slot:icon v-if="bannerPeriod.length == 1 && bannerPeriod[0].characters.length > 0 && bannerPeriod[0].weapons.length > 0">
                <v-avatar size="60" color="white">
                    <v-icon style="position: absolute; left: 3px; top: 3px">mdi-knife</v-icon>
                    <v-divider style="transform: rotate(-45deg)"></v-divider>
                    <v-icon style="position: absolute; right: 3px; bottom: 3px">mdi-account</v-icon>
                </v-avatar>
            </template>
            <template v-slot:icon v-if="bannerPeriod.length == 1 && bannerPeriod[0].characters.length > 0">
                <v-icon>
                    <v-avatar size="60" color="white" :image="`/images/portraits/` + bannerPeriod[0].characters[0].name.replace(' ', '_') + `_Icon.png`"></v-avatar>
                </v-icon>
            </template>
            <template v-slot:icon v-if="bannerPeriod.length == 2 && bannerPeriod[0].characters.length > 0 && bannerPeriod[1].characters.length > 0">
                <v-icon>
                    <v-avatar size="60" color="white">
                        <img style="position: absolute; left: 0; top: 0; width: 100%; height: 100%; clip-path: view-box polygon(0% 0%, 0% 100%, 50% 100%, 50% 0);" :src="`/images/portraits/` + bannerPeriod[0].characters[0].name.replace(' ', '_') + `_Icon.png`">
                        <img style="width: 100%; height: 100%; clip-path: view-box polygon(50% 0%, 100% 0%, 100% 100%, 50% 100%);" :src="`/images/portraits/` + bannerPeriod[1].characters[0].name.replace(' ', '_') + `_Icon.png`">
                    </v-avatar>
                </v-icon>
            </template>
            <template v-slot:opposite>
                <v-chip pill class="mr-1">
                    {{ new Date(bannerPeriod[0].start_date).toLocaleString('en-us',{month:'long', year:'numeric', day: 'numeric'}) }}
                </v-chip>
                <v-icon icon="mdi-calendar-collapse-horizontal"></v-icon>
                <v-chip pill class="ml-1">
                    {{ new Date(bannerPeriod[0].end_date).toLocaleString('en-us',{month:'long', year:'numeric', day: 'numeric'}) }}
                </v-chip>
            </template>
            <v-card v-for="(banner, key) in bannerPeriod">
                <v-card-title class="text-h6">
                    {{ getBannerName(banner) }}
                </v-card-title>
                <v-card-text class="bg-white text--primary pt-3">
                    <v-chip v-for="featured in banner.characters" class="ma-1" pill @click="$emit('click-character', featured.id)">
                        <v-avatar start>
                            <v-img :src="`/images/portraits/` + featured.name.replace(' ', '_') + `_Icon.png`"></v-img>
                        </v-avatar>
                        {{ featured.name }}
                    </v-chip>
                    <v-chip v-for="featured in banner.weapons" class="ma-1" pill @click="$emit('click-weapon', featured.id)">
                        <v-avatar start>
                            <v-img :src="`/images/portraits/` + featured.name.replace(' ', '_') + `_Icon.png`"></v-img>
                        </v-avatar>
                        {{ featured.name }}
                    </v-chip>
                </v-card-text>
            </v-card>
        </v-timeline-item>
    </v-timeline>
</template>