import { CreatePostDto } from './create-post.dto';
import { PostService } from './post.service';
export declare class PostController {
    private readonly postService;
    constructor(postService: PostService);
    getAll(): Promise<import("./post.entity").PostEntity[]>;
    create(dto: CreatePostDto): Promise<import("./post.entity").PostEntity>;
    getById(id: string): Promise<import("./post.entity").PostEntity>;
    update(id: string, dto: CreatePostDto): Promise<import("./post.entity").PostEntity>;
    delete(id: string): Promise<import("typeorm").DeleteResult>;
}
