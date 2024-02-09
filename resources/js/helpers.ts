import { Banner } from "./models";

export function getBannerName(banner: Banner) {
    if(banner.name) return banner.name;

    let featured_five_star = banner.featured.find(f => f.rarity == 5);
    if(featured_five_star) {
        return featured_five_star.featured_name? featured_five_star.featured_name : 'No name'
    }
    return 'No name';
}