import { CreatePostDto } from './post.dto/create_post.dto';
import { PostService } from './post.service';
export declare class PostController {
    private readonly postService;
    constructor(postService: PostService);
    getAll(): Promise<import("./post.entity").Postentity[]>;
    create(dto: CreatePostDto): Promise<any>;
    getById(id: string): Promise<import("./post.entity").Postentity>;
    update(id: string, dto: CreatePostDto): Promise<import("./post.entity").Postentity>;
    delete(id: string): Promise<import("typeorm").DeleteResult>;
}
