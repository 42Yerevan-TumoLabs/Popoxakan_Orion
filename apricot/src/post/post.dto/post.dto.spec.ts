import { PostDto } from './create_post.dto';

describe('PostDto', () => {
  it('should be defined', () => {
    expect(new PostDto()).toBeDefined();
  });
});
